<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

<?php
# Given an array of integers, find the one that appears an odd number of times.
# There will always be only one integer that appears an odd number of times.

#My solution (doesn't work):
    # function findIt(array $seq) : int { 

    #     $assoArr = array();
    #     $odd = 0;
    #     for($i; $i < count($seq); $i++) {
    #         if(!$i) {
    #             array_push($assoArr, $i => 1);
    #         } 
    #         elseif($i) { 
    #             array_push($assoArr, $i => $assoArr[ $i ] + 1);
    #         }
    #     }    
    #     for($i; $i < count($seq); $i++) { 
    #         if($i % 2 !== 0) {
    #             $odd = $i;
    #         }
    #     }
    #     return $odd;
    # }

# Working solution:
function findIt(array $seq) : int
{
    #array_count_values will create basically a frequency associative array
    $nums = array_count_values($seq);
    # nums gets assigned not as a value, but more so as a key-pair
    foreach ($nums as $key => $val) {
        # I guess that 0 is true in PHP??
      if ($val % 2) {
        return $key;
      }
    }
}

#My solution (does not work):
# function compSame($a, $b) { 
    # we take each value of a's array and compare it against each value of b's
    # array in order to check if any of b's array is a square of a's number.
    # while($i < count($a)) { 
    #     if(gettype($a[$i]) === "integer") { 
    #         $i++;
    #     }
    #     else { 
    #         return printf("NOT ALL INDECIES ARE NUMBERS!");
    #     }
    # }

    # for($i; $i < count($a); $i++) { 
    #     for($k; $k < count($b); $k++) { 
    #         if($b[$k] === pow($a[ $i ], 2)) { 
    #             break;
    #         }
    #         elseif($b[count($b)] !== pow($a[ $i ]) { 
    #             return "STOP!";
    #         }
    #     }
    # }
    # echo "IT WORKED! BOTH ARRAYS ARE EQUAL!";
# }

# Their solution:
function comp($a1, $a2) {
  
    # just a super easy type check
  if ( is_null($a1) || is_null($a2) )
    return false;
    
  # map over a php array, just like JavaScript. HOWEVER, the syntax is different.
  # Basically, it's: FIRST callback function, and SECOND which array(s) the callback
  # function will be applied to.
  $t = array_map(function($v) {
    return $v * $v;
  }, $a1);
  
  #used built in sort methods
  sort($a2);
  sort($t);
  echo $a2 == $t;
}

# My solution works!!!! (took me a long-ass time to figure this out though...)
# Their solution is SO Much more simple. it's litterally just return pow($n, 3);
function triOdds($level) { 
    # NEW IDEA: 1 + (2 * x) = the final number we want to get to
    # the row we are on is how many numbers we have, ig row 200 will have 200 numbers.
    # maybe we create an array of numbers, and then whatever row we are on, we
    # just add up the last however many entries into that array!
    # THER IS A DIFFERENT BETWEEN HOW MANY NUMBERS THERE ARE VS HOW MANY LEVELS
    # WE NEED!
    # How to get the numbers we need out of the levels given:
    # go down a level, ---> first for loop
    # on this level, we will add the previous level to a total PLUS the current 
    # level. This will be equivalent to how many total numbers we need to generate
    

    $previousLevel = 0;
    $total = 0;
    $pyrimid = [  ];
    $pyrSum = [  ];
    $prevLevelCount = $level;
    $currLevelCount = $level;
    $dontTouchLevel = $level;
    $totalNums = 0;
    $newTotal = 0;
    for($i = 0; $i < $level; $i++) { 
        if($i !== $totalNums) { 
            $totalNums = $totalNums + ($currLevelCount - $i);
        }
        elseif($level === $currLevelCount && $totalNums === 0) { 
            $totalNums = $prevLevelCount;
        }
    }
     for($i = 0; $i < $totalNums; $i++) { 
         $total++;
         $previousLevel = $previousLevel + $levelCount;
         array_push($pyrimid, (1 + (2 * $i)));
     }
     for($i = 0; $i < $level; $i++) {
         $total = $total + $pyrimid[count($pyrimid) - 1];
         array_unshift($pyrSum, array_pop($pyrimid)); 
     }
     for($k = 0; $k < count($pyrSum); $k++) { 
        $newTotal = $newTotal + $pyrSum[$k]; 
     } 
     return $newTotal;
}

# ____________________________________________________________________________

#Very simple, given a number, find its opposite.

#Examples:

# 1: -1
# 14: -14
# -34: 34

# My function. It was pretty easy, however, they made me write my own failing tests
# which they did not explain in the instructions. the best passing function they
# made is this: return -$n; REALLY great answer. Wish I had remembered to do that.
function opposite($n) {  
        if($n === -1) { 
            echo 1;
        }
        elseif($n === 1) { 
            echo -1;
        }
        else { 
            echo $n - $n * 2;
        }
}

# ________________________________________
#
#
# Task
# You will be given an array of numbers. You have to sort the odd numbers 
# in ascending order while leaving the even numbers at their original positions.
# 
# Examples
# [7, 1]  =>  [1, 7]
# [5, 8, 6, 3, 4]  =>  [3, 8, 6, 5, 4]
# [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]  =>  [1, 8, 3, 6, 5, 4, 7, 2, 9, 0]
#
#
# WHAT I'M THINKING!:
# Basically we need to keep the current array as is for the majority of this.
# I think the idea is that we loop through an array and collect all the indexes
# of each odd number and add that into it's own array. We then take that array
# and sort it. Possibly with the built in sort method. this sorted array will
# be it's own array. So now we have essentially 3 arrays.
# 1. original array
# 2. sorted array
# 3. an array of which numbers go first
#
# The way we get the 3rd array is that the sorted array will actually be an
# associative array with keys of "1", "2", "3", etc. Basically they will be strings,
# so when we reagrage them after the sort, we cankk
# 
# so actually now I'm thinking that we don't do that above^^^
# What we could instead do is make an array of numbers. This array of nums will
# be the positions of the odd numbers. I think this should be step 1

function sortArray(array $arr) : array {
    $oddNumsArr = [];
    $positionsArr = [];
    for($i = 0; $i < count($arr); $i++) { 
        if($arr[$i] % 2 !== 0) { 
            array_push($oddNumsArr, $arr[$i]);
            array_push($positionsArr, $i);
        }
    }

    
    sort($oddNumsArr);
    $newArrAnswer = array_combine($positionsArr, $oddNumsArr);
    $result = array_replace($arr, $newArrAnswer);
    return $result;
}


# Write a function, persistence, that takes in a positive parameter num and 
# returns its multiplicative persistence, which is the number of times you must 
# multiply the digits in num until you reach a single digit.
# 
# For example:
# 
# persistence(39) === 3; // because 3 * 9 = 27, 2 * 7 = 14, 1 * 4 = 4 and 
# 4 has only one digit
#
# persistence(999) === 4; // because 9 * 9 * 9 = 729, 7 * 2 * 9 = 126, 
# 1 * 2 * 6 = 12, and finally 1 * 2 = 2
#
# persistence(4) === 0; // because 4 is already a one-digit number






?>
	
<h1><?php
    sortArray([7, 1, 3, 2, 8, 5, 4, 9]);
?></h1>
</body>
</html>


