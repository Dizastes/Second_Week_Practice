<!DOCTYPE html>
<html lang="en">

<body>
    <div>
    <div class="container_admin">
                <form action="createGroup" method='post' class="form_admin">
                    @csrf
                    <h2>Добавить группу</h2>
                    <select id='select-state' name="direction" placeholder="программа">
                        <option value=""></option>
                        @foreach ($directiones as $direction)
                            <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name='name' placeholder="номер группы">
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="container_admin">
                <form action="giveCourse" method='post' class="form_admin">
                    @csrf
                    <h2>Курс</h2>
                    <select id='select-state' name="group" placeholder="группа">
                        <option value=""></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <select id='select-state' name="course" placeholder="курс">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="container_admin">
                <form action="studentToGroup" method='post' class="form_admin">
                    @csrf
                    <h2>Добавить студента</h2>
                    <select id='select-state' name="group" placeholder="группа">
                        <option value=""></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <select id='select-state' name="user" placeholder="Пользователь">
                        <option value=""></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">+</button>
                </form>
            </div>
            <div>
                <form action="deleteGroup" method='post'>
                    @csrf
                    <h2>Удалить группу</h2>
                    <select id='select-state' name="group" placeholder="группа">
                        <option value=""></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">-</button>
                </form>
            </div>
    </div>
</body>
</html>