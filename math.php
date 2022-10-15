<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz[2]->FUNCTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  
    .alert{
        font-weight: 500;
    }
</style>
<body>

            
        <?php
        
        
        function sum(array $Arr): int {
        if(isset($_POST['submit'])){
                 $num1 =$_POST['value1'];
                $num2 = $_POST['value2'];
          // $num1=90;
           //$num2=320;
            if($num1>0 && $num2>0){
                if($num1<$num2){
                    $firtNum = array_search($num1, $Arr,true);
                    $lastNum = array_search($num2, $Arr,true);
                    if ($lastNum = array_search($num2, $Arr,true)>0){
                        $lastNum = array_search($num2, $Arr,true);
                        }
                        // if($num2>100){
                        //     return 100;
                        // }
                    else{
                        $lastNum = array_search($Arr[count($Arr)-1], $Arr);
                        }     
                    $size = $lastNum - $firtNum + 1;
                    $result = array_sum(array_slice($Arr, $firtNum, $size));
                    return $result;
                }
                else{
                    return 0;
                }
            }
            else{
                return -1;
            }
        }
        }
        
        
        //echo "<div class='alert alert-success'>The sum is:</div>";
        
       ?>
 <?php
 $Arr=[10,20,30,40,50,60,70,80,90,100];
 echo "The sum is"." ". "="." ". sum($Arr);
 ?>
        </div>
    </div>
</body>
</html>

