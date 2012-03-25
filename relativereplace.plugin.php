<?php

class RelativeReplacePlugin extends Plugin
{
	public function replace_macro($match)
	{
		$site_var = $match[1];
		$map = array(
			'SERVERNAME' => 'site',
		);
		if(isset($map[$site_var])) {
			$site_var = $map[$site_var];
		}
		return Site::get_url($site_var);
	}

	public function filter_post_content_out($content)
	{
		$content = preg_replace_callback('#\{\{(\w+?)\}\}#', array($this, 'replace_macro'), $content);
		return $content;
	}

	public function filter_post_content_atom($content)
	{
		$content = preg_replace_callback('#\{\{(\w+?)\}\}#', array($this, 'replace_macro'), $content);
		return $content;
	}
}
?>