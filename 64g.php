<?php
//ascתΪ������
function asc2bin($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<$len; $i++) {
                $data .= sprintf("%08b", ord(substr($temp, $i, 1)));
        }
        return $data;
}
//die(asc2bin("��"));
//������תasc
function bin2asc($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<($len/8); $i++) {
                $data .= chr(intval(substr($temp, $i * 8, 8), 2));
        }
        return $data;
}

$zhbstr=file_get_contents("64g.txt");
$zhbarr=explode("\r\n",$zhbstr);
$zhb=array();
foreach($zhbarr as $key){
	list($a,$b)=explode(":",$key);
	$zhb[$a]=$b;
}
//die(var_export(array_flip($zhb)));



$szb=array("2"=>"��","3"=>"��","4"=>"��","5"=>"��","6"=>"��","7"=>"��","8"=>"��","9"=>"��","10"=>"ʮ");

function z_64g($str){
	global $zhb,$szb;
	$bin=asc2bin($str);
	//$result=strtr($bin,array_flip($zhb));
	$rs="";
	$rns=0;
	for($i=0;$i<strlen($bin);$i=$i+6){
		$nowstr=substr($bin,$i,6);
		//die($nowstr);
		$nns=strtr($nowstr,array_flip($zhb));
		if(strlen($nns)==4){
			$rs.="��".$nns."��";
			$rns=0;
		}else{
			if($rns==3){
				$rs.=$nns."��";
				$rns=0;
			}else{
				$rs.=$nns;
				$rns++;	
			}
		}
	
		
		
		
	}
	$rs=strtr($rs,array("����"=>"��","����"=>"��","��"=>"��\n"));
	return $rs;
}
function de_64g($str){
	global $zhb,$szb;
	$dszb=array_flip($szb);
	$rs=strtr($str,array("��"=>"","��"=>"","\n"=>""));


	$rs=bin2asc(strtr($rs,$zhb));
	return $rs;
}

echo (z_64g('���Ƴ�����LADY-077 ˮҰ���� ͩԭ������ ˮ�� ��ˮ����(1987��5��20- )���������ձ�����������ΪAVŮ�ţ��С����ڹ��ɽࡱ֮�ơ�ˮ������ALICE JAPAN��ϣ־��Ұ�Լ��ߺ�����֮��2008���Ƴ������ˡ���������: http://pan.baidu.com/s/1c0BZ7zy ����: 4q7t'));