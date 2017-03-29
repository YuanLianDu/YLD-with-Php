# [魔术方法](http://php.net/manual/zh/language.oop5.magic.php)

通常情况下，开发者不会主动调用魔术方法，而是在特定的时机被PHP系统自动调用，也可以通俗地理解为事件监听方法。

+ `__construct()`
+ `__distruct()`
+ `__set()`
+ `__get()`
+ `__isset()`
+ `__unset()`
+ `__sleep()`
+ `__wakeup()`
+ `__toString()`
+ `__invoke()`
+ `__clone()`
+ `__call()`
+ `__callStatic()`
+ `__autoload()`


##  [重载方法](http://php.net/manual/zh/language.oop5.overloading.php#object.isset)

当调用未定义或者不可访问的类属性或方法时，重载方法会被调用；
所有的重载方法都必须被声明为 public。
**这些魔术方法的参数都不能通过引用传递。**

属性重载：

+ `__set($key,$value)`
+ `__get($key)`
+ `__isset($key)`
+ `__unset($key)`

方法重载：

+ `call($name,$arguments)`,在对象中调用一个不可访问方法时，__call() 会被调用。
+ `callStatic($name,$arguments)`,在静态上下文中调用一个不可访问方法时，__callStatic() 会被调用。

