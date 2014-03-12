<?php

class PerchMembers_Template extends PerchAPI_TemplateHandler
{
	private $Session = false;

	public $tag_mask = 'member|else:member';


	public function render_runtime($contents, $Template)
	{
		if (strpos($contents, 'perch:member')!==false) {
            
            //PerchUtil::debug(PerchUtil::html($contents));

			$Session = PerchMembers_Session::fetch();
			$this->Session = $Session;

			

			// CONTENT
	    	$contents 	= $Template->replace_content_tags('member', $Session->to_array(), $contents);

	    	//PerchUtil::debug(PerchUtil::html($contents));

	    	// Clean up
	    	$s 			= '/<perch:member\s[^>]*\/>/';
			$contents	= preg_replace($s, '', $contents);



			// CONDITIONALS
			$i = 0;
	        while (strpos($contents, 'perch:member')>0 && $i<10) {
	            
	            $s = '/(<perch:member[^:>\/]*>)(((?!perch:member).)*)<\/perch:member>/s';
	    		
	    		$count	= preg_match_all($s, $contents, $matches, PREG_SET_ORDER);
			    
	    		if ($count > 0) {		    
	    			foreach($matches as $match) {
	    			    $contents = $this->parse_conditional($match[1], $match[2], $match[0], $contents);
	    			}	
	    		}
	    		
	    		$i++;
	    	}

	    	

        }

		return $contents;
	}



	protected function parse_conditional($opening_tag, $condition_contents, $exact_match, $template_contents)
	{
	    
		$Tag = new PerchXMLTag($opening_tag);

		//PerchUtil::debug($Tag);
		//PerchUtil::debug(PerchUtil::html($condition_contents));

		$type = false;

		if ($Tag->logged_in() || $Tag->logged_out()) {
			$type = 'auth';
		}elseif ($Tag->has_tag()) {
			$type = 'tag';
		}else{
			$type = 'data';
		}

		//PerchUtil::debug('Condition: '.$type, 'error');
		
		$Session = $this->Session;

		$positive = $condition_contents;
        $negative = '';
        	        
        // else condition
        if (strpos($condition_contents, 'perch:else:member')>0) {
	        $parts   = preg_split('/<perch:else:member\s*\/>/', $condition_contents);
            if (is_array($parts) && count($parts)>1) {
                $positive = $parts[0];
                $negative = $parts[1];
            }
        }    
		
		switch($type) 
		{

			case 'auth':
        
            	if (($Session->logged_in && $Tag->logged_in()) || (!$Session->logged_in && $Tag->logged_out())) {
            		$template_contents  = str_replace($exact_match, $positive, $template_contents);
            	}else{
            		$template_contents  = str_replace($exact_match, $negative, $template_contents);
            	}

				break;


			case 'tag':
				if ($Session->has_tag($Tag->has_tag())) {
					$template_contents  = str_replace($exact_match, $positive, $template_contents);
            	}else{
            		$template_contents  = str_replace($exact_match, $negative, $template_contents);
				}

				break;


			default:
				if (strpos($condition_contents, 'perch:else:member')>0) {
					$condition_contents = preg_replace('/<perch:else:member\s*\/>/', '', $condition_contents);
				}
				$template_contents  = str_replace($exact_match, $condition_contents, $template_contents);
				
				break;

		}
	    
	    return $template_contents;
	}

}


?>