<?php
	
	$CC="g++";
	$out="timeout 5s ./a.out";
	$code=$_REQUEST["code"];
	
	//$input='2 3';
	$cppCodeFile="main.cpp";
	//$inputFile="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$cppCodeFile;	
	$command_error=$command." 2>".$filename_error;
	$check=0;
	
	$file_code=fopen($cppCodeFile,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	
	//$file_in=fopen($inputFile,"w+");
	//fwrite($file_in,$input);
	//fclose($file_in);
	
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");
	
	shell_exec($command_error);
	
	$error=file_get_contents($filename_error);
	
	
	$executionStartTime = microtime(true);
	$preDefinedInput=file_get_contents($inputFile);
	
	if(trim($error)=="")
	{
		if(trim($preDefinedInput)=="")
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
		
		//echo $output .'<br>'.'first if condition'.'<br>';
	}
	else if(!strpos($error,"error"))
	{
		//echo "<pre>$error</pre>";
		if(trim($preDefinedInput)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$inputFile;
			$output=shell_exec($out);
		}
		//echo $output .'<br>'.'second if condition'.'<br>';
	}
	else
	{
		//echo "<pre>$error</pre>". ' occurs in last else condition (compilation error)';
		$check=1;
	}
	
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);


	if($check==1)
	{
		$verdict="Compilation error";
		//echo "<pre>Compilation error</pre>";
	}
	else if($check==0 && $seconds> $timeLimit)
	{
		$verdict="Time limit exceed";
		//echo "<pre>Time limit exceed</pre>";
	}
	else if(trim($output)=="")
	{
		$verdict="Run Time Error";
		//echo "<pre>Run Time Error</pre>";
	}
	else if($check==0)
	{
		$preDefinedOutput=file_get_contents($solutionFile);

		//echo ' preDefinedOutput without trim is '.$preDefinedOutput.'<br>';
		//echo ' Output without trim is '.$output.'<br>'.'<br>'.'<br>';

		$preDefinedOutput=preg_replace('/\s+/', '', $preDefinedOutput);
		$output=preg_replace('/\s+/', '', $output);
		//echo ' preDefinedOutput after trim is '.$preDefinedOutput.'<br>';
		//echo ' Output after trim is '.$output.'<br>'.'<br>'.'<br>';
		if( $preDefinedOutput == $output ){
			$verdict="Accepted";
			//echo "<pre>Verdict : AC</pre>";
		}else{
			$verdict="Wrong Answer";
			//echo "<pre>Verdict : Wrong Answer</pre>";
		}

	}
	exec("rm $cppCodeFile");
	exec("rm *.o");
	exec("rm *.txt");
	exec("rm $executable");
	//echo "<pre>Compiled And Executed In: $seconds s</pre>";

	
?>
