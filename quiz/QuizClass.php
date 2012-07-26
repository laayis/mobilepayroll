<?php

function make_seed(){
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}

function generateOperator(){
	$temp = 0;
	$letter=5;	
	// seed with microseconds
	mt_srand(make_seed());
	$letter = mt_rand(0, 3);
	
	if($letter=='0'){
		$letter='+';
	}else
	if($letter=='1'){
		$letter='-';
	}else
	if($letter=='2'){
		$letter='*';
	}else
	if($letter=='3'){
		$letter='/';
	}
	
	//$temp=mt_rand(5, 15);
	return $letter;
}
/*
function generateLetter(){
	$temp = 0;
	$key='';

	// seed with microseconds
	mt_srand(make_seed());
	$temp = mt_rand();
	$letter = chr(($temp % 26) + 97);
	//$temp=mt_rand(5, 15);
	return $letter;
}
*/
function generateNDigitId($n){
	$temp = 0;
	$key='';
	$result=1;
	$id=0;
	for(;$result!=0;){
		// seed with microseconds
		//mt_srand(make_seed());
		//$temp = mt_rand(-pow(10, $n), pow(10,$n));
		$temp = rand(-pow(10, $n), pow(10,$n));
		$id=$temp;
		//$id = substr($temp,0,$n);
		//$temp=mt_rand(5, 15);

		//echo $result . '<br />';
		//echo $i . '<br />';
		$result=0;
	}
	//echo $id . '<br />';
	return intval($id);
}
/*
function trialdivision($n){
//def trial_division(n):
    """Return a list of the prime factors for a natural number."""
    if n == 1: return [1]
    primes = prime_sieve(int(n**0.5) + 1)
    prime_factors = []
 
    for p in primes:
        if p*p > n: break
        while n % p == 0:
            prime_factors.append(p)
            n //= p
    if n > 1: prime_factors.append(n)
 
    return prime_factors
}
*/
function factorize($n)
{
    $n=abs($n);
    $primes = array();
    if(($n-round($n)) !=0){
	return $primes;
    } else{
	return array('a');
    }
   /* 
    $d = 2;
    if($n < 2) return;
    //echo 'Prime factors of "' . $n . ':';
    while($d < $n) {
    if($n % $d == 0) {
    $primes[] = $d;
    //echo $d." x ";
    $n /= $d;
    }
    else {
    if($d == 2) $d = 3;
    else $d += 2;
    }
    }
    $primes[] = $d;
    //echo $d;

    return $primes;
*/
}


function generateOptions($mode=1, $op){
	$a = generateNDigitId($mode);
	$b = generateNDigitId($mode);
	$ans=0;
	if($op=='+'){
		$ans=$a+$b;
	}else
	if($op=='-'){
		$ans=$a-$b;
	}else
	if($op=='*'){
		$ans=$a*$b;
	}else
	if($op=='/'){
		//find divisors for $a
		
		while(!($b = generateNDigitId($mode))){};
		$ans=$a/$b;
		while(!count(factorize($ans))){
			while(!($b = generateNDigitId($mode))){};
			$ans=$a/$b;
		}
	}

	echo $a . '' . $op . '' . $b . '=' . $ans;
	return $ans;
}



?>
