<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Введите ваши данные</h2>
						<form method="post" name="login" action="">
							
							<input type="email" name="email" placeholder="Email" /><span class="error"><?= $var['emailError'] ?></span>
							<input type="password"  name="password" placeholder="Пароль" /> <span class="error"><?= $var['passwordErrorLength'] ?></span>
							<p><span>
								<input type="checkbox" name="remember"  class="checkbox"  value="1"> 
								Сохранить
							</span></p>
							<button type="submit" name="submit-log" class="btn btn-default" value="1">Войти</button><span class="error"><?= $var['userOK'] ?></span>
						</form>
					</div><!--/login form-->
				</div>
		
			</div>
		</div>
	</section><!--/form-->