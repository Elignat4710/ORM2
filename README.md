## Настройка
1. Настроить конфиг для покдлючение к бд
2. Сделать `composer install`
3. Для создаия собственной модели нужно:
   - наследоваться от `App\Models\Model`
   - прописать в свойство название таблицы `protected $table = 'smt'`


## Примеры работы
1. Создание
```php
$user = new UserModel();
$user->name = 'Max';
$user->email = 'test@gmail.com';
$user->save();
```
2. Поиск
    - По айди
    ```php
    $user = UserModel::find(1);
    ```
   - Несколько записей по условию
    ```php 
    $posts = PostModel::where(['title', '=', 'title'])->get()
    ```
3. Обновление
    - Массовое обновление
    ```php 
    PostModel::where(['title', '=', 'title'])->update([
        'title' => 'test'
    ])
    ```
   - Для одной модели
    ```php
    $post = PostModel::find(1);
    $post->body = 'SMT text for body';
    $post->update(); 
    ```

4. Удаление
    - Массовое удаление
    ```php
    PostModel::where(['title', '=', 'title 2'])->delete(); 
    ```
   - Удаление для одной модели
    ```php
   $post = PostModel::find(3);
   $post->delete(); 
    ```
5. Join
```php
PostModel::with(
    'users', 
    'user_id', 
    'id'
)
    ->where([['title', '=', 'title']])
    ->get(); 
```