const timeOut = 5000;
function AlertShow(message){
	$('.alert h4').text(message);
	$('.alert').show();
	setTimeout(function(){
		$('.alert').hide();
		$('.alert h4').text('');
	}, 5000);
}
$(document).ready(function(){
	$('.settings-box .btn-toggle').click(function(){
		$(this).html($(this).html()=='»'?'&laquo;':'&raquo;');
		$('.settings-box').toggleClass('opened');
	});
	$('form[name="systemSettings"]').submit(function(e){
		e.preventDefault();
		let min=$(this).find('[name="min"]').val(),
			max=$(this).find('[name="max"]').val();
		$('.settings-box .loader').addClass('animated');
		$.post('index.php',{'action':'config','min':min,'max':max},function(data){
			$('.settings-box .loader').removeClass('animated');
			if(typeof(data.status)!=='undefined'){
				if(data.status){
					$('.settings-box').toggleClass('opened');
				}
				else{
					AlertShow(data.error);
				}
			}
			else{
				AlertShow('AJAX error');
			}
		},'json');
	});
	$('form[name="emulator"]').submit(function(e){
		e.preventDefault();
		let iq=$(this).find('[name="iqLevel"]').val(),
			table = $('#resultTable tbody');
		$('#emulatorLoader').addClass('animated');
		table.empty();
		$('#totalResults').text('');
		$.post('index.php',{'action':'emulate','iq':iq},function(data){
			if(typeof(data.status)!=='undefined'){
				if(data.status){
					let resultsCounter=0;
					$.each(data.results,function(){
						if(this.result){
							resultsCounter++;
						}
						table.append(
						'<tr>\
							<td>'+this.number+'</td>\
							<td>'+this.qid+'</td>\
							<td>'+this.qusing+'</td>\
							<td>'+this.qlevel+'</td>\
							<td class="result">'+(this.result?'+':'&times;')+'</td>\
						</tr>'
						);
					});
					$('#totalResults').text('Тестируемый ответил правильно на '+resultsCounter+' вопросов из 40');
					$('#testsTable tbody').append(
					'<tr>\
						<td>'+data.insert.id+'</td>\
						<td>'+data.insert.iq+'</td>\
						<td>'+data.insert.minlevel+' - '+data.insert.maxlevel+'</td>\
						<td>'+data.insert.results+'</td>\
					</tr>'
					);
				}
				else{
					AlertShow(data.error);
				}
			}
			else{
				AlertShow('AJAX error');
			}
			$('#emulatorLoader').removeClass('animated');
		},'json');
	});
});