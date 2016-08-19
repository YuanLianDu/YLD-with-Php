# Linux-CPU

> 运行机器ubuntu
## 获取CPU信息

如何才能获得CPU的信息呢？如进程、缓存、速度等。
可以使用以下命令获取CPU的所有信息。

命令：`cat /proc/cpuinfo`

输出：
```
root@iZ2399d17ctZ:~# cat /proc/cpuinfo
processor	: 0
vendor_id	: GenuineIntel
cpu family	: 6
model		: 63
model name	: Intel(R) Xeon(R) CPU E5-2680 v3 @ 2.50GHz
stepping	: 2
microcode	: 0x1
cpu MHz		: 2494.224
cache size	: 30720 KB
physical id	: 0
siblings	: 1
core id		: 0
cpu cores	: 1
apicid		: 0
initial apicid	: 0
fpu		: yes
fpu_exception	: yes
cpuid level	: 13
wp		: yes
flags		: fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush mmx fxsr sse sse2 ss syscall nx pdpe1gb rdtscp lm constant_tsc rep_good nopl eagerfpu pni pclmulqdq ssse3 fma cx16 pcid sse4_1 sse4_2 x2apic movbe popcnt tsc_deadline_timer aes xsave avx f16c rdrand hypervisor lahf_lm abm xsaveopt
bogomips	: 4988.44
clflush size	: 64
cache_alignment	: 64
address sizes	: 46 bits physical, 48 bits virtual
power management:
```

## 查看资源占用

命令：`top`

输出：
```
top - 12:14:27 up 3 days, 19:23,  1 user,  load average: 0.08, 0.03, 0.05
Tasks:  78 total,   2 running,  76 sleeping,   0 stopped,   0 zombie
%Cpu(s):  0.3 us,  0.3 sy,  0.0 ni, 99.3 id,  0.0 wa,  0.0 hi,  0.0 si,  0.0 st
KiB Mem:   2049904 total,  1889312 used,   160592 free,   102416 buffers
KiB Swap:        0 total,        0 used,        0 free.  1477336 cached Mem

  PID USER      PR  NI    VIRT    RES    SHR S %CPU %MEM     TIME+ COMMAND
  751 root      20   0    1544    584    500 S  0.3  0.0   2:38.71 aliyun-service
  983 root      20   0  669620  10924   6768 S  0.3  0.5   4:46.27 AliHids
14250 mysql     20   0  623924  51120   7612 S  0.3  2.5   2:01.26 mysqld
    1 root      20   0   33500   2804   1468 S  0.0  0.1   0:01.37 init
    2 root      20   0       0      0      0 S  0.0  0.0   0:00.00 kthreadd
```

参数解释：
```
PID（Process ID）：进程标示号。
USER：进程所有者的用户名。
PR：进程的优先级别。
NI：进程的优先级别数值。
VIRT：进程占用的虚拟内存值。
RES：进程占用的物理内存值。
SHR：进程使用的共享内存值。
S：进程的状态，其中S表示休眠，R表示正在运行，Z表示僵死状态，N表示该进程优先值是负数。
%CPU：该进程占用的CPU使用率。
%MEM：该进程占用的物理内存和总内存的百分比。
TIME＋：该进程启动后占用的总的CPU时间。
Command：进程启动的启动命令名称，如果这一行显示不下，进程会有一个完整的命令行。
```

## 查看内存使用情况
命令： `free`


