<?php defined('BASEPATH') OR exit('No direct script access allowed');

class resize_lib
{
	private $name = "x";
	public $cache_dir = "uploads/cache/";
	
	function __construct($config = array())
	{
		$this->CI =& get_instance();
	}

	public function resize($image_src, $width = 0, $height = 0)
	{	
		$this->set($image_src, $width, $height);
				
		if(file_exists($this->cache_dir.$this->name))
			return $this->name;
		
		$this->set($image_src, $width, $height);
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image_src;
		$config['new_image'] = $this->cache_dir.$this->name;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;

		$this->CI->load->library('image_lib', $config);

		if($this->CI->image_lib->resize())
			return $this->get();
		else
			return;
	}
	
    private function get_extension($file_name)
    {
        $ext = explode('.', $file_name);
        $ext = array_pop($ext);
        return strtolower($ext);
    }
	
	private function set($image_src, $width, $height)
	{
		$this->name = $this->get_name($image_src).'-'.$width.'x'.$height.'.'.$this->get_extension($image_src);
	}
	
	private function get()
	{
		return $this->name;
	}
	
    private function get_name($file_name)
    {
        $ext = explode('.', $file_name);
        $ext = array_shift($ext);
        $ext = strtolower($ext);
		$pos = strrpos($ext, '/');
		
		if($pos == false)
		{
			return $ext;
		}
		else
		{
			$pos = explode('/', $ext);
			$pos = array_pop($pos);
			return $pos;
		}
    }
}