<?php
	
	$CC="gcc";
	$out="timeout 5s ./a.out";
	$code=$_POST["CCode"];
	
	$input='2 3';
	$CCodeFile="main.c";
	$inputFile="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$CCodeFile;	
	$command_error=$command." 2>".$filename_error;
	$check=0;
	
	$file_code=fopen($CCodeFile,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	
	$file_in=fopen($inputFile,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");
	
	shell_exec($command_error);
	
	$error=file_get_contents($filename_error);
	
	
	$executionStartTime = microtime(true);
	
	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			//$out=$out." > output.txt";
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$inputFile;
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
			$out=$out." < ".$inputFile;
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


	if($check==1)
	{
		echo "<pre>Compilation error</pre>";
	}
	else if($check==0 && $seconds>3)
	{
		echo "<pre>Time limit exceed</pre>";
	}
	else if(trim($output)=="")
	{
		echo "<pre>Run Time Error</pre>";
	}
	else if($check==0)
	{
		echo "<pre>Verdict : AC</pre>";
	}
	exec("rm $CCodeFile");
	exec("rm *.o");
	exec("rm *.txt");
	exec("rm $executable");
	echo "<pre>Compiled And Executed In: $seconds s</pre>";



	
	
	
	
?>
