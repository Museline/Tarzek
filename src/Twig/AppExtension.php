<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('bbcode2html', array($this, 'bbcode2htmlFilter'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    public function bbcode2htmlFilter($txt)
    {
    	$conv_bbcode2html = array(
    		'\[b\](.*?)\[\/b\]' => '<strong>$1</strong>', 
    		'\[i\](.*?)\[\/i\]' => '<em>$1</em>', 
    		'\[u\](.*?)\[\/u\]' => '<u>$1</u>', 
    		'\[del\](.*?)\[\/del\]' => '<del>$1</del>',
    		'\[img\](.*?)\[\/img\]' => '<img src="$1"/>', 
    		'\[url=([^\]]*)\](.*?)\[\/url\]' => '<a href="$1" target="_blank">$2</a>',
            '\[list\]\r?(.*?)\[\/list\]\r?' => '<ul class="editeur_liste">$1</ul>',
            '\[ul\]\r?(.*?)\[\/ul\]\r?' => '<ul class="editeur_liste">$1</ul>',
            '\[\*\](.*?)[\r]' => '<li>$1</li>',
            '\[li\](.*?)\[\/li\]\r?' => '<li>$1</li>',
            '\r' => '<br />',
    		);

		foreach ($conv_bbcode2html as $key => $value) 
		{
			$txt = preg_replace('/'.$key.'/s', $value, $txt);
		}

        return $txt;
    }

    public function getName()
    {
        return 'app_extension';
    }
}
