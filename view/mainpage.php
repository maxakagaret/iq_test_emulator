<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Эмулятор IQ-тестирования</title>
	<link href="css/bootstrap.min.css" media="all" rel="Stylesheet" type="text/css" />
	<link href="css/styles.css" media="all" rel="Stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
		<h1>Эмулятор IQ-тестирования</h1>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="emulator-tab" data-toggle="tab" href="#emulator" role="tab" aria-controls="emulator" aria-selected="true">Эмулятор</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tests-tab" data-toggle="tab" href="#tests" role="tab" aria-controls="tests" aria-selected="false">Список тестов</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="emulator" role="tabpanel" aria-labelledby="emulator-tab">
				<form method="post" action="" name="emulator">
					<div class="row">
						<div class="col-8">
							<label>Уровень IQ теструемого субъекта</label>
							<input type="number" name="iqLevel" class="form-control" value="0" />
						</div>
						<div class="col-4">
							<label>&nbsp;</label>
							<br />
							<button type="submit" class="btn btn-success">Запустить эмулятор</button>
						</div>
						<div class="col">
							<div id="emulatorLoader" class="loader"></div>
						</div>
					</div>
				</form>
				<hr />
				<table id="resultTable" class="table table-dark table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">ID Вопроса</th>
							<th scope="col">Кол-во использований</th>
							<th scope="col">Сложность</th>
							<th scope="col">Результат</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<ht />
				<h4 id='totalResults'></h4>
			</div>
			<div class="tab-pane fade" id="tests" role="tabpanel" aria-labelledby="tests-tab">
				<table id="testsTable" class="table table-dark table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">IQ</th>
							<th scope="col">Сложность</th>
							<th scope="col">Результат</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($tests as $test) {
						echo '
						<tr>
							<td>'.$test['id'].'</td>
							<td>'.$test['iq'].'</td>
							<td>'.$test['levelmin'].' - '.$test['levelmax'].'</td>
							<td>'.$test['result'].'</td>
						</tr>';
					}					
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="settings-box">
		<button type="button" class="btn btn-toggle">&raquo;</button>
		<h4>Настройки</h4>
		<form method="post" action="" name="systemSettings">
			<div class="row">
    			<div class="col">
    				<div class="form-group">
	    				<label>Минимальная сложность</label>
						<input type="number" name="min" max="99" min="0" class="form-control" value="<?php echo $minLevel?>"/>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Максимальная сложность</label>
						<input type="number" name="max" max="100" min="1" class="form-control" value="<?php echo $maxLevel?>"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="submit" class="btn btn-success">Сохранить</button>
				</div>
				<div class="col">
					<div class="loader"></div>
				</div>
			</div>
		</form>
	</div>
	<div class="alert">
		<h4></h4>
	</div>
	<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/scripts.js" type="text/javascript"></script>
</body>
</html>