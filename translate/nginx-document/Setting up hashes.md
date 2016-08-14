# ［nginx文档翻译系列］设置hashes
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
