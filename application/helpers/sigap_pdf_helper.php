<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");
    
    $dompdf = new DOMPDF();
	$dompdf->set_paper("a4", "landscape");
    $dompdf->load_html($html);
    $dompdf->render();
	
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
*/
function pdf_create($html, $filename, $stream, $papersize, $orientation, $stn)
 
    {
 
        require_once('dompdf/dompdf_config.inc.php');
 
        $dompdf = new DOMPDF();
 
        $dompdf->load_html($html);
 
        $dompdf->set_paper($papersize, $orientation);
 
        $dompdf->render();
 
        if ($stream)
 
        {
 
             $options['Attachment'] = 1;
 
             $options['Accept-Ranges'] = 0;
 
             $options['compress'] = 1;
 
         	$dompdf->stream($filename. '.pdf', $options);
 
        }
 
        else
 
        {
 			$CI =& get_instance();  
        	$CI->load->helper('file');  
        	write_file("/localhost/wmskno/pdf/$filename.pdf", $dompdf->output());
            #write_file('$filename.pdf', $dompdf->output());
 
        }
 
    }


