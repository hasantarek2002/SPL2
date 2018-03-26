<?php
	
	$CC="gcc";
	$out="timeout 5s ./a.out";
	//$code=$_POST["code"];
	/*
	$code='#include<stdio.h>
			int main(){
				printf("hi");
			return 0;
			}';
	*/
	/*
	$code='#include<stdio.h>
			int main(){
			int a;
				scanf("%d",&a);
				printf("%d",a);
			return 0;
			}';
	*/
	/*
	$code='#include<stdio.h>
			int main(){
			int arr[10000];
			int i=0;

			arr[15]=2;

			printf("hello\n");


			for(i=0;i<10000;i++){
				printf("hello\n");

			}
		}';
	*/
	/*
	$code='#include<stdio.h>

			//segmentation fault
			int main(){
			int arr[1000000000];
			int i=0;

			arr[15]=2;

			printf("hello\n");

		}';
	*/
	
	/*
	$code='#include<stdio.h>

			//segmentation fault (core dumped)
			int main(){
			int arr[10];
			int i=0;

			arr[15]=2;

			printf("hello\n");

		}';
	*/
	/*
	$code='#include<stdio.h>
			int main(){
				int a;
				scanf("%d",&a);
				printf("%d",a);
			return 0;
			}';
	
	*/
	
	$code='#include<stdio.h>
			//infinite loop
			int main(){
			
			int i=0;

			for(i=0;;i++){
				printf("hello\n");

			}
		}';
	//$input=$_POST["input"];
	$input='2';
	//$input='';
	$filename_code="main.c";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	$check=0;
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");
	
	shell_exec($command_error);
	
	$error=file_get_contents($filename_error);
	//echo $error;
	
	
	$executionStartTime = microtime(true);
	//echo $executionStartTime.'<br>';
	//$executionStartTime = sprintf('%0.2f', $executionStartTime);
	
	//echo trim($error).'<br>'."trim ends";
	
	
	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			//$out=$out." > output.txt";
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			//$out=$out." > output.txt";
			$output=shell_exec($out);
		}
		
		echo $output .'<br>'.'first if condition'.'<br>';
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		echo $output .'<br>'.'second if condition'.'<br>';
	}
		else
	{
		echo "<pre>$error</pre>". ' occurs in last else condition (compilation error)';
		$check=1;
	}
	
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	echo "<pre>Compiled And Executed In: $seconds s</pre>";
	
	
	
	
?>
