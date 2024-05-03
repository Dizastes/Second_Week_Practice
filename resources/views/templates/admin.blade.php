<header class="d-flex justify-content-between container mt-4 mb-3">
    <div>
        @if ($user_role == 1)
            <h2>Администратор</h2>
        @elseif ($user_role == 2)
            <h2>Руководитель ОПОП</h2>
        @elseif ($user_role == 3)
            <h2>Руководитель практики</h2>
        @else
            <h2>Студент</h2>
        @endif
    </div>
    <div class="user_head_btn">
        @if ($user_role == 1)
            <a href="/admin" class="btn btn-outline-secondary">Страница Администратора</a>
        @elseif ($user_role == 2)
            <a href="/opop" class="btn btn-outline-secondary">Страница Руководителя ОПОП</a>
            <a href="/groups" class="btn btn-outline-secondary">Страница Редактирования Групп</a>
        @elseif ($user_role == 3)
            <a href="/practic" class="btn btn-outline-secondary">Страница Руководителя Практики</a>
        @else
            <a href="/student" class="btn btn-outline-secondary">Страница Студента</a>
        @endif
        <a href="/logout" class="btn btn-outline-secondary">Выход</a>
    </div>
</header>
