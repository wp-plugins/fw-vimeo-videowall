<?php
/**
 * @package fw-vimeo-videowall
 * @author fairweb
 * @version 1.0
 */

/**
 * Description of fwvimeovideowallclass
 *
 * @author Fairweb
 */
class FW_vimeo_videowall {
    public $id;
    public $vsource;
    public $vtype;
    public $vcall;
    public $api_endpoint;
    public $vwidth;
    public $vheight;
    public $vnumber;
    public $vecho;

    function FW_vimeo_videowall() {
       __construct();
    }
    function __construct() {

    }

    public function choose_endpoint () {
        global $fwvvw_user_name;
        switch ($this->vsource) {
            case 'user' : $this->api_endpoint = 'http://www.vimeo.com/api/v2/'.$this->id.'/videos.json'; break;
            case 'group' : $this->api_endpoint = 'http://www.vimeo.com/api/v2/group/'.$this->id.'/videos.json'; break;
            case 'album' : $this->api_endpoint = 'http://www.vimeo.com/api/v2/album/'.$this->id.'/videos.json'; break;
            case 'channel' : $this->api_endpoint = 'http://www.vimeo.com/api/v2/channel/'.$this->id.'/videos.json'; break;
            case 'video' : $this->api_endpoint = 'http://www.vimeo.com/api/oembed.json'; break;
            default : $this->api_endpoint = 'http://www.vimeo.com/api/v2/'.$this->id.'/videos.json'; break;
        }
    }

    public function video_wall($args) {
        $this->id = $args['id'];
        $this->vsource = $args['source'];
        $this->vnumber = $args['number'];
        $this->vwidth = $args['width'];
        $this->vheight = $args['height'];
        $this->vtype = $args['type'];
        $this->choose_endpoint ();
        $video_details = $this->get_datas();

        $html='<div class="fwvvw-'.$this->vsource.'">';
       
        if (!$video_details) {
         if ($args['echo'] == true) {
                 _e('No video', 'fwvvw');
         } else {
                 return false;
         }
        }
         $html .= $this->get_html($video_details);
         $html .='<div class="fwclear"></div></div>';
         if ($args['echo'] == false) {
                 return $html;
         } else {
                 echo $html;
         }

    }

    public function display_single_video ($video_id) {
        $this->id = $video_id;
       
        $this->vsource = 'video';
        $this->choose_endpoint ();
        $oembed_url = $this->api_endpoint.'?url='.rawurlencode('http://vimeo.com/'.$this->id).'&maxwidth='.$this->vwidth.'&maxheight='.$this->vheight;       
        $oembed_req = wp_remote_retrieve_body( wp_remote_get($oembed_url));
        $oembed = json_decode($oembed_req);
        $embed_code = html_entity_decode($oembed->html);
        echo $embed_code;
    }

    public function get_html($video_details) {
        $full_html = '';
        if ($video_details) {
        switch ($this->vtype) {
            case 'video' :
                foreach ($video_details as $video) {
                    $full_html .= $this->get_video_html ($video);
                }
                break;
            default :
                 foreach ($video_details as $video) {
                    $full_html .= $this->get_image_html ($video);
                }
                break; // default is image
        }
        }
        return $full_html;
    }

    public function get_video_html ($video) {
        $oembed_endpoint = 'http://vimeo.com/api/oembed.json';
        $oembed_url = $oembed_endpoint.'?url='.rawurlencode($video->url).'&maxwidth='.$this->vwidth.'&maxheight='.$this->vheight;
        $oembed_req = wp_remote_retrieve_body( wp_remote_get($oembed_url));
        $oembed = json_decode($oembed_req);
        $html_code = '<div id="'.$video->id.'" class="fwvvw_vthumb">';
        $html_code .= html_entity_decode($oembed->html);
        $html_code .= '</div>';
        return $html_code;
    }

    public function get_image_html ($video) {
         $html_code = '<div id="'.$video->id.'" class="fwvvw_vthumb">';
         $html_code .= '<img src="'.$video->thumbnail_small.'" alt="'.$video->title.'" title="'.$video->title.'" width="'.$this->vwidth.'" />';
         $html_code .= '</div>';
         return $html_code;
    }

    public function get_datas() {

        $endpoint_req = wp_remote_retrieve_body( wp_remote_get($this->api_endpoint));
        $videos = json_decode($endpoint_req );
        
        $video_details = array();
        $nb = count($videos);
        $this->vnumber = $this->vnumber == 0 ? $nb : $this->vnumber;
        for ($i=0; $i < $this->vnumber; $i++) {
            if ($i == $nb) { break; }
            $videos_details [] = $videos[$i];
        }
        return $videos_details;
    }
}


?>