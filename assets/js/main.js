$(function () { // when document is ready
    // ------------------------------------------
    // Body mass index function
    function mbi(mass, height, gender) {
        $result = mass  / (height * height) ; 
        //height in cm 
        $height = $height / 100 ; 
        if ($result < 15 ){
            $bmi_value = "����� ��� ��� ����" ;
        }
        else if ( $resule >= 15 && $resulr < 16 ){
            $bmi_value = "����� �����" ; 
        }
        else if( $resule >= 16 && $resulr < 18.5 ){
            $bmi_value = "�����" ; 
        }
        else if($result >= 18.5 && $result < 25 ){
            $bmi_value = "�����" ; 
        }
        else if($result >= 25 && $result < 30  ){
            $bmi_value = "����" ; 
        }
        else if($result >= 30 && $result < 35  ){
            $bmi_value = "���� ������" ; 
        }
        else if($result >= 35 && $result < 40  ){
            $bmi_value = "���� �����" ; 
        }
        else{
            $bmi_value = "���� ��� ��� ����" ; 
        }
        
        return $nmi_value;
    }

    // ------------------------------------------

});