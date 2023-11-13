<section>
    <div class="container">
        <div class="row">

            <h3>Кабинет пользователя</h3>
            
            <h4>Здравствуйте, <?php echo $_SESSION['login']; ?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Изменить регистрационные данные</a></li>
                <li><a href="/cabinet/history">Посмотреть историю заказов</a></li>
                 <li><a href="/cart/">Посмотреть содержимое корзины</a></li>
            </ul>
            
        </div>
    </div>
</section>