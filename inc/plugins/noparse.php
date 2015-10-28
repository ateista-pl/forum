<?php
/************************************************************
* author       : Ad Bakker
* plugin       : Noparse BBCode
* last_mod     : 06.10.2011 (June 10th 2011)
* version      : 1.0
*************************************************************/
if(!defined('IN_MYBB'))
{
    die("This file cannot be accessed");
}

//
// make sure "noparse_run" is called at the start op the parsing process
//
$plugins->add_hook("parse_message_start", "noparse_run");

function noparse_info () {
    return array (
        "name"        => "Tag [noparse]",
        "description"    => "Tag [noparse], MyCode source",
        "author"    => "Ad Bakker",
        "version"    => "1.0",
    );
}

function noparse_activate () {
// Activate plugin
// no action required
}

function noparse_deactivate () {
// Deactivate plugin
// no action required
}

function noparse_run ($message) {
//
// In between the [noparse] and [/noparse] tags all square bracket characters
// "[" and "]" are replaced by the Unicode equivalemts &#91 and &#93, respectively.  
// By that they remain their "looks" but BBCode tags are no longer recognized as  
// such by the BBCode parsing process
//
    $match_pattern = '#\[noparse\](.*?)\[/noparse\]#is';
    if (preg_match_all($match_pattern,$message,$matches,PREG_SET_ORDER)) {
        foreach ($matches as $found) {
//
//            remove noparse tags
//
            $replace = preg_replace($match_pattern,"$1",$found[0]);
//
//            replace square brackets by Unicode equivalents
//
            $replace = str_replace(array('[',']'),array('&#91;','&#93;'),$replace);
//
//                      replace text in between noparse tags by text with converted brackets
//
            $message = preg_replace($match_pattern,$replace,$message,1);
        }
    }
    return $message;
}

?>