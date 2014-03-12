<?php
    # Side panel
    echo $HTML->side_panel_start();

    //echo $HTML->para('');

    echo $HTML->side_panel_end();
    
    
    # Main panel
    echo $HTML->main_panel_start();
	
	include('_subnav.php');

    echo '<a class="add button" href="'.$HTML->encode($API->app_path().'/edit/').'">'.$Lang->get('Add Member').'</a>';

	# Title panel
    echo $HTML->heading1('Listing Members');
    
    if (isset($message)) echo $message;
?>

    <?php
    /* ----------------------------------------- SMART BAR ----------------------------------------- */
    if (true || PerchUtil::count($members)) {
    ?>


    <ul class="smartbar">
        <li class="<?php echo ($status=='all'?'selected':''); ?>"><a href="<?php echo PerchUtil::html($API->app_path()); ?>?status=all"><?php echo $Lang->get('All'); ?></a></li>
        <li class="new <?php echo ($status=='pending'?'selected':''); ?>"><a href="<?php echo PerchUtil::html($API->app_path().'?status=pending'); ?>"><?php echo $Lang->get('Pending'); ?></a></li>
        <?php

            if (PerchUtil::count($tags)) {
                $items = array();
                foreach($tags as $Tag) {
                    $items[] = array(
                            'arg'=>'tag',
                            'val'=>$Tag->tag(),
                            'label'=>$Tag->tagDisplay(),
                            'path'=>$API->app_path()
                        );
                }

                echo PerchUtil::smartbar_filter('cf', 'By Tag', 'Filtered by ‘%s’', $items, 'folder', $Alert, "You are viewing members with tag ‘%s’", $API->app_path());
            }
           
            
        
        ?>
    </ul>

    <?php
        }else{
            $Alert->set('notice', $Lang->get('There are no members yet.'));
        }

    ?>

     <?php echo $Alert->output(); ?>


    <?php

    /* ----------------------------------------- /SMART BAR ----------------------------------------- */
    ?>



<?php    
    if (PerchUtil::count($members)) {
?>
    <table class="d">
        <thead>
            <tr>
                <th class="first"><?php echo $Lang->get('Email'); ?></th>
                <th><?php echo $Lang->get('Status'); ?></th>
                <th><?php echo $Lang->get('Joined'); ?></th>
                <th class="action last"></th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach($members as $Member) {
?>
            <tr>
                <td class="primary">
                    <a href="<?php echo $HTML->encode($API->app_path()); ?>/edit/?id=<?php echo $HTML->encode(urlencode($Member->id())); ?>">
                    <?php echo $HTML->encode($Member->memberEmail()); ?></a>
                </td>
                <td>
                <?php 
                    if ($Member->memberStatus()=='pending') {
                        echo '<span class="special">'.$HTML->encode(ucfirst($Member->memberStatus())).'</span>';
                    }else{
                        echo $HTML->encode(ucfirst($Member->memberStatus())); 
                    }
                ?>
                </td>
                <td><?php echo $HTML->encode(strftime('%d %B %Y', strtotime($Member->memberCreated()))); ?></td>
                <td><a href="<?php echo $HTML->encode($API->app_path()); ?>/delete/?id=<?php echo $HTML->encode(urlencode($Member->id())); ?>" class="delete inline-delete" data-msg="<?php echo $Lang->get('Delete this member?'); ?>"><?php echo $Lang->get('Delete'); ?></a></td>
            </tr>

<?php   
    }
?>
        </tbody>
    </table>
<?php    
        if ($Paging->enabled()) {
            echo $HTML->paging($Paging);
        }
    

    } // if pages
    
    echo $HTML->main_panel_end();
?>