<?php

	require_once 'Calculator.php';
	$message = '';
	$carValue;
	$taxPercentage;
	$instalments;

	if(filter_has_var(INPUT_POST, 'submit')){

		$carValue = $_POST['carValue'];
		$taxPercentage = $_POST['taxPercentage'];
		$instalments = $_POST['instalments'];

		if(!empty($carValue) && !empty($taxPercentage) && !empty($instalments)){
			if($carValue < 100 || $carValue > 100000){
				$message = 'Value of a car has to be within 100 and 100,000 EUR';
			}
			else if($taxPercentage <= 0 || $taxPercentage > 100){
				$message = 'Tax Percentage has to be within 1 and 100%';
			}
			else if($instalments <1 || $instalments > 12){
				$message = 'Installment payment has to be within 1 and 12 months';
			}
			else{				
                $p1 = new Calculator($carValue, $taxPercentage, $instalments);
            }
		}
		else{
			$message = 'All fields are required';
		}
	}
?>

<html>
    <head>
        <title>Insly Calculator</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    	</head>

    <body>

		<div class="container">
			<h1 class="text-center">Insly Insurance Calculator</h1>
			<form action='' method="POST">

				<?php if($message != ''): ?>
					<div class="alert alert-danger text-center" role="alert">
						<?php echo $message; ?>
					</div>
				<?php endif; ?>
				

				<div class="form-group row">
					<label for="carValue" class="col-sm-2 col-form-label">Car Value</label>
					<div class="col-sm-10">
						<input type="Number" class="form-control" id="carValue" name="carValue"
						 placeholder="Car Value(100-100,000)" value="<?php echo isset($_POST['carValue']) ? $carValue : '';?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="taxPercentage" class="col-sm-2 col-form-label">Tax Percentage</label>
					<div class="col-sm-10">
						<input type="Number" class="form-control" id="taxPercentage" name="taxPercentage" 
						placeholder="Tax Percentage(0-100)"  value="<?php echo isset($_POST['taxPercentage'])  ? $taxPercentage : '';?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="instalments" class="col-sm-2 col-form-label">Number of instalments</label>
					<div class="col-sm-10">
						<input type="Number" class="form-control" id="instalments" name="instalments" 
						placeholder="Number of instalments"  value="<?php echo isset($_POST['instalments'])  ? $instalments : '';?>">
					</div>
				</div>

				<div class="form-group row">
					<div class="offset-sm-6 col-sm-4">
						<button type="submit" class="btn btn-primary" name="submit">Calculate</button>
					</div>
				</div>

			</form>

			<?php if(!empty($carValue) && !empty($taxPercentage) && !empty($instalments)): ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Policy</th>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <th scope="col"><?php echo $i?> instalment</th>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            <th scope="row">Value</th>
                            <td><?php echo sprintf("%.2f", $carValue); ?></td>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <td></td>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>
                        
                        <tr>
                            <th scope="row">Base Premium (<?php echo $p1->getPolicy()*100  .'%)'; ?></th>
                            <td><?php echo sprintf("%.2f", $p1->getBasePremium()); ?></td>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <td><?php echo sprintf("%.2f", $p1->getInstalmentPrice()); ?></td>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>
                        
                        <tr>
                            <th scope="row">Commission (<?php echo $p1->getCommissionPercentage()*100  .'%)'; ?></th>
                            <td><?php echo sprintf("%.2f", $p1->getCommission()); ?></td>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <td><?php echo sprintf("%.2f", $p1->getInstalmentCommission()); ?></td>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>

                        <tr>
                            <th scope="row">Tax (<?php echo $taxPercentage .'%)'; ?></th>
                            <td><?php echo sprintf("%.2f", $p1->getTax()); ?></td>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <td><?php echo sprintf("%.2f", $p1->getInstalmentTax()); ?></td>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>

                        <tr>
                            <th scope="row">Total Cost</th>
                            <td><?php echo sprintf("%.2f", $p1->getTotal()); ?></td>
                            <?php
                                if($instalments > 1):
                                    for ($i = 1; $i <= $instalments; $i++):									
                            ?>
                                <td><?php echo sprintf("%.2f", $p1->getInstalmentTotal()); ?></td>
                            <?php
                                endfor;
                                endif;
                            ?>
                        </tr>
                    </tbody>
                </table>

			<?php endif;?>



		</div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>