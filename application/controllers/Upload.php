<?php

class Upload extends CI_Controller
{
// ------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

// ------------------------------------------
    public function index()
    {
        //$this->listFiles();
        $this->load->view('upload/form', array('error' => ' '));
    }

// ------------------------------------------
    public function uploadMultiImgs()
    { // رفع عدة صور إلى الموقع
        $files_array = array(); // مصفوفة فيها أسماء الملفات بعد الرفع
        if (!empty($_FILES)) {
            // general upload configurations:
            $config['upload_path']      = './assets/uploads/';
            $config['allowed_types']    = '*';
            $config['file_ext_tolower'] = true;

            $this->load->library('upload');

            $files           = $_FILES;
            $number_of_files = count($_FILES['file']['name']);
            $errors          = 0;

            // codeigniter upload just support one file
            // to upload. so we need a litte trick
            for ($i = 0; $i < $number_of_files; $i++) {
                $config['file_name'] = time(); // تسمية الملفات المرفوعة
                sleep(1); // انتظار ثانية قبل رفع كل ملف ليتغير اسمه عن اللي قبلو

                $_FILES['file']['name']     = $files['file']['name'][$i];
                $_FILES['file']['type']     = $files['file']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                $_FILES['file']['error']    = $files['file']['error'][$i];
                $_FILES['file']['size']     = $files['file']['size'][$i];

                // we have to initialize before upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload("file")) {
                    $DT = $this->upload->data(); // كائن فيه كل معلومات الملف
                    array_push($files_array, $DT['orig_name']); // اضافة أسماء الملفات إلى مصفوفة الأسماء
                } else {
                    $errors++;
                    // print_r( $this->upload->display_errors() );
                }


            } // end for loop ( 0 -> number of files)

            if ($errors > 0) {
                $null = array();
                echo(json_encode(array_filter($null)));
                return;

            }

        } // end if ( ! empty($_FILES))
        /*
        elseif ($this->input->post('file_to_remove')) // لحذف ملف غير مستخدمة حالياً
        {
            $file_to_remove = $this->input->post('file_to_remove');
            unlink("./assets/uploads/" . $file_to_remove);
        }
        else {}
        */
        echo(json_encode(array_filter($files_array))); // file names like [ "file_1", "file_2", "file_3", ... ]
    }

// ------------------------------------------
    private function listFiles()
    {
        $this->load->helper('file');
        $files = get_filenames("./assets/uploads");
        echo json_encode($files);
    }
    // ------------------------------------------


    /* upload (second way: ) start */

    function upload()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view('upload/upload_form', array('error' => ' '));
    }

// --------------------------------------------------------
    function do_upload()
    {
        $this->load->helper(array('form', 'url'));
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|zip|swf';
        $config['max_size']      = '30000';
        $config['max_width']     = '1024';
        $config['max_height']    = '768';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload/upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['file_name'];
            $ext  = $data['upload_data']['file_ext'];
            $dir1 = $config['upload_path'] . $file;
            $name = time() . $ext;
            $dir2 = $config['upload_path'] . $name;
            rename($dir1, $dir2);
            $data2['data'] = array('ext' => $ext, 'dir' => $name);

            $this->load->view('upload/upload_success', $data2);
        }
    }

// ------------------------------------------
    function wm($imgUrl)
    { // ختم الصورة بشعار الموقع
        $this->load->library('image_lib');
        $img                        = "./assets/uploads/$imgUrl";
        $config['image_library']    = 'gd'; //GD, GD2, ImageMagick, NetPBM
        $config['source_image']     = $img;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './files2/images/stamp.png'; //the overlay image
        $config['wm_opacity']       = 50;
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark())
            echo $this->image_lib->display_errors();

    }

    // ----------------------
    function up1()
    {
        $this->load->view('upload/up1');
    }

// --------------
    function up2()
    {
        $this->load->view('upload/up2');
    }

// ------------------------------------------
    /* دالة إنشاء صورة مصغرة */
    function creatThumb($img) // width = height = 370
    {
        list($init_width, $init_height) = getimagesize('./assets/uploads/' . $img);
        /* القيم التالية في حال كان عرض الصورة الأصلية يساوي ارتفاعها */
        $x          = 0; /* إحداثيات قطع الصورة المصغرة  */
        $y          = 0;
        $new_width  = $init_width; /* أبعاد الصورة الجديدة (المصغرة) */
        $new_height = $init_height;

        if ($init_width > $init_height) { /* إذا كان عرض الصورة الأصلية أكبر من ارتفاعها */
            $x         = ($init_width - $init_height) / 2;
            $new_width = $init_height;

        }
        if ($init_height > $init_width) { /* إذا كان ارتفاع الصورة الأصلية أكبر من عرضها */
            $y          = ($init_height - $init_width) / 2;
            $new_height = $init_width;
        }

        $conf = [
            "image_library"  => 'gd2',
            "source_image"   => './assets/uploads/' . $img,
            "new_image"      => './assets/uploads/thumb_' . $img,
            "quality"        => "100%",
            "maintain_ratio" => FALSE,
            "width"          => $new_width,
            "height"         => $new_height,
            "x_axis"         => $x,
            "y_axis"         => $y
        ];

        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($conf);

        if (!$this->image_lib->crop()) {
            echo $this->image_lib->display_errors();
        } else {
            $this->image_lib->clear();
            $conf = [
                "image_library" => 'gd2',
                "source_image"  => './assets/uploads/thumb_' . $img,
                "width"         => 370,
                "height"        => 370,
            ];

            $this->image_lib->initialize($conf);
            if (!$this->image_lib->resize())
                echo $this->image_lib->display_errors();
            else echo "done";
        }
    }

// --------------------------------------------------------
    function creatThumb_Basci($img)
    {
        //$i = imagecreatefromjpeg('./assets/uploads/'.$img);
        list($w, $h) = getimagesize('./assets/uploads/' . $img);
        //$w = imagesx($i);
        //$h = imagesy($i);
        $x = 0;
        $y = 0;
        if ($w > $h) {
            $x = ($w - 2 * $h) / 2;
            $W = 2 * $h;
            $H = $h;
        }
        if ($h > $w || $w == $h) {
            $y = (2 * $h - $w) / 4;
            $H = $w / 2;
            $W = $w;
        }
        if ($w == 2 * $h) {
            $W = $w;
            $H = $h;
        }
        // echo "w=".$w."<br />h=".$h."<br />x=".$x."<br />y=".$y."<br />d=".$W."<br />";
        $conf['image_library']  = 'gd2';
        $conf['source_image']   = './assets/uploads/' . $img;
        $conf['new_image']      = './assets/uploads/thumb_' . $img;
        $conf['quality']        = "100%";
        $conf['maintain_ratio'] = false;
        $conf['width']          = $W;
        $conf['height']         = $H;
        $conf['x_axis']         = $x;
        $conf['y_axis']         = $y;

        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($conf);

        if (!$this->image_lib->crop()) {
            echo $this->image_lib->display_errors();
        } else {
            $this->image_lib->clear();
            $conf['image_library'] = 'gd2';
            $conf['source_image']  = './assets/uploads/thumb_' . $img;
            $conf['width']         = 370;
            $conf['height']        = 200;
            $this->image_lib->initialize($conf);
            if (!$this->image_lib->resize()) echo $this->image_lib->display_errors();
            else echo "done";
        }
    }

// ------------------------------------------
    function watermark_image($img)
    {
        $this->load->library('image_lib');
        $config['source_image'] = base_url() . 'assets/uploads/' . $img;
        // $config['source_image'] = './uploads/images.jpg';
        // $config['new_image'] = './uploads/';
        $config['wm_type'] = 'overlay';

        $config['wm_overlay_path'] = base_url() . 'files2/images/stamp.png';


        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'left';
        // $config['wm_padding'] = '20';

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);

        $this->image_lib->watermark();
        // $ThumbnailName = 'wm.jpg';

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
    }
    /* upload (second way: ) end */
    // ------------------------------------------

    function updatePhoto()
    {
        $imgUrl = $this->input->post('url');
        $id     = $this->session->userId;
        $this->admin_model->updatePhoto($id, $imgUrl);
    }
    // ------------------------------------------
    /* حذف ملف */
    function unlink($fileName)
    {
        $file      = './assets/uploads/' . $fileName;
        $fileThumb = './assets/uploads/thumb_' . $fileName;
        if (unlink($file) && unlink($fileThumb))
            echo "deleted successfully";
    }

}
