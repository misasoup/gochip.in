<?php
    
    $Members = new PerchMembers_Members($API);
    $message = false;
    
    $Tags = new PerchMembers_Tags($API);

    $HTML = $API->get('HTML');

    if (isset($_GET['id']) && $_GET['id']!='') {
        $memberID = (int) $_GET['id'];    
        $Member = $Members->find($memberID);
        $details = $Member->to_array();
    
        $heading1 = 'Editing a Member';

    }else{
        $Member = false;
        $memberID = false;
        $details = array();

        $heading1 = 'Adding a Member';
    }

    $heading2 = 'Member details';
    

    $Form = $API->get('Form');

    $Form->require_field('memberEmail', 'Required');

    if (!is_object($Member)) {
        $Form->require_field('memberPassword', 'Required');
    }

    if ($Form->submitted()) {
   	        
        $postvars = array('memberEmail', 'memberStatus');
		
    	$data = $Form->receive($postvars);

    	$result = false;
    	
    	
    	if (is_object($Member)) {
    	    $Member->update($data);
            $result = true;
    	}else{

            $data['memberCreated'] = date('Y-m-d H:i:s');

            // Password
            if (isset($_POST['memberPassword']) && $_POST['memberPassword']!='') {
                $clear_pwd = trim($_POST['memberPassword']);
                if (defined('PERCH_NONPORTABLE_HASHES') && PERCH_NONPORTABLE_HASHES) {
                    $portable_hashes = false;
                }else{
                    $portable_hashes = true;
                }
                $Hasher = new PasswordHash(8, $portable_hashes);
                $data['memberPassword'] = $Hasher->HashPassword($clear_pwd);            
            }


            if (!$Members->check_email($data['memberEmail'])) {
                $message = $HTML->failure_message('A member with that email address already exists.');
            }else{

                $data['memberProperties'] = '';

                $Member = $Members->create($data);
                if ($Member) {

                    $member = array(
                        'memberAuthID'=>$Member->id()
                    );

                    $Member->update($member);

                    if (isset($_POST['send_email']) && $_POST['send_email']=='1') {
                        $Member->send_welcome_email();
                    }

                    $result = true;
                    PerchUtil::redirect($API->app_path() .'/edit/?id='.$Member->id().'&created=1');
                }else{
                    $message = $HTML->failure_message('Sorry, that member could not be updated.');
                }
            }
    	    
    	}


        // Tags
        if ($result) {

            // existing tags
            $existing_tagIDs = $Form->find_items('tag-', true);
            $Tags->remove_from_member($Member->id(), $existing_tagIDs);
            

            // new tag
            if (isset($_POST['new-tag']) && $_POST['new-tag']!='') {
                $tagset = $Tags->parse_string($_POST['new-tag']);
                if (PerchUtil::count($tagset)) {

                    if (isset($_POST['new-expire']) && $_POST['new-expire']!='') {
                        $tag_expiry = $Form->get_date('new-expires');
                        if (!$tag_expiry) $tag_expiry=false;
                    }else{
                        $tag_expiry = false;
                    }

                    foreach($tagset as $tag) {
                        $Tag = $Tags->find_or_create($tag['tag'], $tag['tagDisplay']);
                        $Tag->add_to_member($Member->id(), $tag_expiry);
                    }
                }
            }


            if (isset($_POST['send_email']) && $_POST['send_email']=='1') {
                $Member->send_welcome_email();
            }


        }





    	
        if ($result) {
            $message = $HTML->success_message('The member has been successfully updated. Return to %smember listing%s', '<a href="'.$API->app_path() .'">', '</a>');  
        }else{
            if (!$message) $message = $HTML->failure_message('Sorry, that member could not be updated, or no changes were made.');
        }
        
        if (is_object($Member)) {
            $details = $Member->to_array();
        }else{
            $details = array();
        }
        
    }
    
    if (isset($_GET['created']) && !$message) {
        $message = $HTML->success_message('The member has been successfully created. Return to %smember listing%s', '<a href="'.$API->app_path() .'">', '</a>'); 
    }


    if (is_object($Member)) {
        $tags = $Tags->get_for_member($Member->id());
    }else{
        $tags = false;
    }

?>