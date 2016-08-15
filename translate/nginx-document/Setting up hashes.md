# ［nginx文档翻译系列］设置散列
>原文链接：http://nginx.org/en/docs/hash.html

如果有地方翻译的不合理，请多多指教。
虽然翻译了，但并不是很能理解:sweat_smile:

为了快速处理静态数据集如服务器的名字、[map](http://nginx.org/en/docs/http/ngx_http_map_module.html#map)指令的值、MIME类型、请求头字符串的名字、
nginx使用hash表。在开始的期间，每一个重新配置的nginx选择了hash表中最小的有可能的尺寸，使得bucket大小即存储
key具有相同的hash值不会超过所配置的参数。（`hash bucket`大小）。表的大小在bucket中表示。调整会继续直到表的大小
超过了hash最大值参数。大多数hash具有相应的指令允许更改这些参数，比如，比如服务器名称的hash指令是[server_names_hash_max_size](http://nginx.org/en/docs/http/ngx_http_core_module.html#server_names_hash_max_size)
和[server_names_hash_bucket_size](http://nginx.org/en/docs/http/ngx_http_core_module.html#server_names_hash_bucket_size)。

`hash bucket`大小参数对应的大小是高速缓存大小的倍数。这将加速在hash的key搜索，在现在的处理器中
通过减少内存访问的次数。如果一个`hash bucket`大小参数等于一个处理器的高速缓存大小，则最坏的情况下，在key搜索时会有两次
内存访问。第一次是计算bucket的地址，第二次是在bucket中进行key搜索的时候。因此，如果nginx发出增大hash的最大值
或者是`hash bucket`大小的消息时，应该首先增大前者。


翻译结束后，并不是很理解，所以查阅了资料，找到了以下文章，可供大家参考。

+ [Hash表,此文章有部分错误](http://www.cnblogs.com/dolphin0520/archive/2012/09/28/2700000.html)

`因此查找成功时的平均查找长度为(1+2+1+3+3+2)/6=11/6`应该是`(1+2+1+3+3+2)/16 = 12/6`
`查找失败时的平均查找长度为(1+7+6+5+4+3+2+1+1+1+1+1+1+1)/14=38/14`应该是`(1+7+6+5+4+3+21+1+1+1+1+1+1)/14 = 35/14`

+ [现代魔法学院-hash系列文章](http://www.nowamagic.net/academy/detail/3008010)
+ [Nginx 源代码笔记 - 哈希表 [1]](http://ialloc.org/posts/2014/06/06/ngx-notes-hashtable-1/)
+ [Nginx 源代码笔记 - 哈希表 [2]](http://ialloc.org/posts/2014/06/06/ngx-notes-hashtable-2/)
