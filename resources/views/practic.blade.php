<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('templates.include')
    <title>Practic</title>
</head>

<body>
    @include('templates.header')
    <main class="main_admin">
        <div class="section">
            <h1>Руководитель практики</h1>
        </div>
        <div>
            <form action="addPractStudent" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container_admin">
                    <h2>Практика</h2>
                    <select id='select-practic' name="practic" placeholder="Практика">
                        <option value=""></option>
                        @foreach ($practics as $practic)
                            <option value="{{ $practic->id }}">{{ $practic->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Выбрать студента</h2>
                    <select id='select-student' name="student" placeholder="Студент">
                        <option value=""></option>
                        @foreach ($students as $student)
                            <option value="{{ $student[0]->id }}">{{ $student[0]->second_name }}
                                {{ $student[0]->first_name }}
                                {{ $student[0]->third_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Вид договора</h2>
                    <select id='select-agreement' name="agreement" placeholder="Вид договора">
                        <option value=""></option>
                        @foreach ($agreement as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Оплачиваемая ли</h2>
                    <input type="checkbox" name="money">
                </div>
                <div class="container_admin">
                    <h2>Прошел ли практику</h2>
                    <input type="checkbox" name="complete">
                </div>
                <div class="container_admin">
                    <h2>Причина(если не прошел практику)</h2>
                    <select id='select-volume' name="reason" placeholder="Причина">
                        <option value=""></option>
                        @foreach ($reasons as $reason)
                            <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Оценка</h2>
                    <select id='select-mark' name="mark" placeholder="Оценка">
                        <option value=""></option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Производственные задачи</h2>
                    <label class="input-file">
                        <span class="input-file-text" type="text"></span>
                        <input type="file" name="file">
                        <span class="input-file-btn">Выберите файл</span>
                    </label>
                </div>
                <div class="container_admin">
                    <h2>Качества</h2>
                    <select id='select-characteristics' name="characteristics[]" class="selectmore"
                        placeholder="Качествва" multiple>
                        <option value=""></option>
                        @foreach ($characteristics as $characteristic)
                            <option value="{{ $characteristic->id }}">{{ $characteristic->charact }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Объем выполнения</h2>
                    <select id='select-volume' name="volume" placeholder="Объем">
                        <option value=""></option>
                        @foreach ($volumes as $volume)
                            <option value="{{ $volume->id }}">{{ $volume->volume }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Замечания</h2>
                    <select id='select-remarks' name="remarks[]" class="selectmore" placeholder="Замечания" multiple>
                        <option value=""></option>
                        @foreach ($remarks as $remark)
                            <option value="{{ $remark->id }}">{{ $remark->remarks }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container_admin">
                    <h2>Как справлялся с проблемами</h2>
                    <select id='select-problem' name="problem[]" class="selectmore" placeholder="Спавлялся с проблемами"
                        multiple>
                        <option value=""></option>
                        @foreach ($problems as $problem)
                            <option value="{{ $problem->id }}">{{ $problem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="section">
                    <button type="submit" class="mybtn">Сохранить</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });

        $("select.selectmore").selectize({
            delimiter: ",",
            persist: false,
            maxItems: null,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            }
        });

        $('.input-file input[type=file]').on('change', function() {
            let file = this.files[0];
            $(this).closest('.input-file').find('.input-file-text').html(file.name);
        });
    </script>
</body>

</html>
