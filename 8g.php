<?php
/*MIT License

Copyright (c) 2016 Gentle Kwan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.*/
//ascתΪ������
function asc2bin($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<$len; $i++) {
                $data .= sprintf("%08b", ord(substr($temp, $i, 1)));
        }
        return $data;
}
//������תasc
function bin2asc($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<($len/8); $i++) {
                $data .= chr(intval(substr($temp, $i * 8, 8), 2));
        }
        return $data;
}

$zhb=array("111"=>"Ǭ","000"=>"��","010"=>"��","101"=>"��","001"=>"��","100"=>"��","110"=>"��","011"=>"��","1"=>"��","0"=>"��");


$szb=array("2"=>"��","3"=>"��","4"=>"��","5"=>"��","6"=>"��","7"=>"��","8"=>"��","9"=>"��","10"=>"ʮ");

function z_bg($str){
	global $zhb,$szb;
	$bin=asc2bin($str);
	$result=strtr($bin,$zhb);
	$rs="";
	$rn=substr($result,0,2);
	$nownums=1;
	$jh=0;
	for($i=2;$i<strlen($result)+2;$i=$i+2){
		$nowstr=substr($result,$i,2);

		if($nowstr==$rn&&$nownums<10){
			$nownums++;
		}else{
			if($nownums>1){
				$rs.=$rn.$nownums;
			}else{
				$rs.=$rn;
			}
			$nownums=1;
		}
			$rn=$nowstr;
	}
	$rs=strtr($rs,$szb);
	$result="";
	for($i=0;$i<strlen($rs);$i=$i+8){
		$result.=substr($rs,$i,8);
		if($i+8<strlen($rs)&&!$jh){
			$result.="��";
			$jh=1;
		}else{
			$result.="��\n";
			$jh=0;
		}
		
	}	
	return $result;
}
function de_bg($str){
	global $zhb,$szb;
	$dzhb=array_flip($zhb);
	$dszb=array_flip($szb);
	$str=strtr($str,array("��"=>"","��"=>"","\n"=>""));
	
	$rs="";
	$rn=substr($str,0,2);
	for($i=2;$i<strlen($str)+2;$i=$i+2){
		$nowstr=substr($str,$i,2);
		$rns=$nowstr;
		$nowstr=strtr($nowstr,$dszb);
		if(strlen($nowstr)==1){
			$rs.=str_repeat($rn,$nowstr);
			$rns="";
		}else{
			$rs.=$rn;
		}
		$rn=$rns;
	}
	$rs=bin2asc(strtr($rs,$dzhb));
	return $rs;
}

echo (z_bg('���Ƴ�����LADY-077 ˮҰ���� ͩԭ������ ˮ�� ��ˮ����(1987��5��20- )���������ձ�����������ΪAVŮ�ţ��С����ڹ��ɽࡱ֮�ơ�ˮ������ALICE JAPAN��ϣ־��Ұ�Լ��ߺ�����֮��2008���Ƴ������ˡ���������: http://pan.baidu.com/s/1c0BZ7zy ����: 4q7t'));