<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


// ------------------- function get thumb
/* جلب أول صورة من محتوى النص */
if (!function_exists('get_first_image')) {
    function get_first_image($post)
    {
        $first_img = '';
        preg_match_all('/<img [^>]*src=["|\']([^"|\']+)/i', $post, $out);
        if ($out[1])
            $first_img = $out[1][0];
        if (empty($first_img)) { //Defines a default image
            $first_img = getFirstImgFromVideo($post);
            if (empty($first_img)) $first_img = base_url() . "assets/images/defult_thumb.jpg";
        }
        return $first_img;
    }
}
// ------------------------------------------
/* تابع يجلب اسم أول صورة بالمقال أو يعيد 0 */
if (!function_exists('getFirstImgFromVideoIfExist')) {
    function getFirstImgFromVideoIfExist($post)
    {
        $first_img = '';
        preg_match("|.*?/embed/([\w-]+)|", $post, $out);
        if (isset($out[1]))
            $first_img = 'http://img.youtube.com/vi/' . $out[1] . '/0.jpg';
        if (empty($first_img)) return false;
        else return $first_img;
    }
}
// ------------------------------------------

/* تابع يجلب اسم اول صورة بالمقال أو يعيد 0 */
if (!function_exists('get_first_image_if_exist')) {
    function get_first_image_if_exist($post)
    {
        $first_img = '';
        preg_match_all('/<img [^>]*src=["|\']([^"|\']+)/i', $post, $out);
        if ($out[1])
            $first_img = $out[1][0];
        if (empty($first_img))
            $first_img = getFirstImgFromVideoIfExist($post);
        return $first_img;
    }
}

// ------------------ /function get thumb
if (!function_exists('get_words')) {
    function get_words($string, $words)
    {
        return implode(' ', array_slice(explode(' ', strip_tags($string)), 0, $words));
    }
}
// ------------------ /dd
if (!function_exists('dd')) {
    function dd($obj)
    {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
        die();
    }
}

// --------------------- watermark
if (!function_exists('watermark_image')) {

    function watermark_image($img)
    {
        echo $img;
        $CI = get_instance();
        $CI->upload->watermark_image($img);
    }
}
// ---------------     get first image from youtube post

if (!function_exists('getFirstImgFromVideo')) {
    function getFirstImgFromVideo($post)
    {
        $first_img = '';
        preg_match("|.*?/embed/([\w-]+)|", $post, $out);
        if (isset($out[1]))
            $first_img = 'http://img.youtube.com/vi/' . $out[1] . '/0.jpg';
        if (empty($first_img)) { //Defines a default image
            $first_img = base_url() . "assets/images/defult_thumb.jpg";
        }
        return $first_img;
    }
}
// ------------------------------------------
if (!function_exists('get_country')) {
    function get_country()
    {
        if (file_get_contents("http://ipinfo.io/" . $_SERVER['REMOTE_ADDR'] . "/country")) {
            $country_code = file_get_contents("http://ipinfo.io/" . $_SERVER['REMOTE_ADDR'] . "/country");
            preg_match("/\w+/", $country_code, $k);
            $k = $k[0];
            return strtoupper($k);
        } else return false;
    }
}


// ------------------------------------------ get image src from text
// like img1.jpg,img2,jpg => img1.jpg
// ------------------ /function get NO.comments
if (!function_exists('getImgFromTxt')) {
    function getImgFromTxt($Imgs)
    {
        if ($Imgs) {
            $a = explode(",", $Imgs);
            $i = base_url() . "assets/uploads/thumb_" . $a[0];
        } else $i = base_url() . "assets/images/defult_thumb.jpg";
        return $i;
    }
}
// ------------------ / xxx.jpg => http://nitrition-guide.com/assets/uploads/xxx.jpg
if (!function_exists('getImgFromTxt3')) {
    function getImgFromTxt3($Img)
    {
        if ($Img) {
            $i = base_url() . "assets/uploads/" . $Img;
        } else $i = base_url() . "assets/images/defult_thumb.jpg";
        return $i;
    }
}
// ------------------ /function get NO.comments
if (!function_exists('getImgFromTxt2')) {
    function getImgFromTxt2($Imgs)
    {
        if ($Imgs) {
            $a = explode(",", $Imgs);
            $i = base_url() . "assets/uploads/" . $a[0];
        } else $i = base_url() . "assets/images/defult_thumb.jpg";
        return $i;
    }
}
// ------------------ /function get NO.comments
if (!function_exists('getImgFromTxtBig')) {
    function getImgFromTxtBig($Imgs)
    {
        if ($Imgs) {
            $a = explode(",", $Imgs);
            $i = base_url() . "assets/uploads/thumb_" . $a[0];
        } else $i = base_url() . "assets/images/defult_thumb.jpg";
        return $i;
    }
}

// ------------------------------------------
if (!function_exists('getImgFromTxtLrg')) {
    function getImgFromTxtLrg($Imgs)
    {
        if ($Imgs) {
            $a = explode(",", $Imgs);
            $i = base_url() . "assets/uploads/" . $a[0];
        } else $i = base_url() . "assets/images/defult_thumb.jpg";
        return $i;
    }
}
// ------------------------------------------
if (!function_exists('offsetAdd')) {
    function offsetAdd($timeGMT, $offsetToAdd)
    {
        $dt = "";
        if ($offsetToAdd) {
            $e = explode(':', $offsetToAdd);

            preg_match("/\d{2}/", $e[0], $h);
            //preg_match("/[+-]{1}/", $offsetToAdd, $si);
            preg_match_all("/[+-]/", $offsetToAdd, $si);
            $h = $h[0];
            $m = $e[1];

            // echo '<pre>'; print_r($si[0]); echo '</pre>';

            if (in_array("+", $si[0]))
                $dt = date('d-m-Y h:i:s', strtotime("+ $h hours $m minutes ", strtotime($timeGMT)));
            if (in_array("-", $si[0]))
                $dt = date('d-m-Y h:i:s', strtotime("- $h hours $m minutes ", strtotime($timeGMT)));


        } else $dt = $timeGMT;
        return $dt;
    }
}
// ------------------------------------------
