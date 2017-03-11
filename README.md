PHP相关题库
---

##PHP相关
###基础
- 命名空间
- 自动加载
- 惰性加载
- 空合并运算符
- 使用 ** 进行幂运算
- 组合比较符 <=>

###性能分析
- xhprof
- php-fpm 慢日志
    > php-fpm.conf配置文件request_slowlog_timeout
    a
    
- vmstate
- iotop

###设计模式
- 单例
- 工厂
- 观察者
- 装饰器

###php的坑
- 对 0, "", '', array(), false, null, new Std() 的判断
- 传引用的坑

##语言无关

###消息队列
- RabbitMQ
- ActiveMQ
- Redis

###通用解决方案
- 抢红包,抢票系统
- 抽奖系统
- feed
- 订单异步处理
- 分布式事务
- 微服务
- 跨网络环境服务

###高可用架构
- nginx
- redis
- memcache
- mysql

##算法
- 快速排序
- 归并算法,外排序
- B树,B+树

###mysql
- 为什么增加过多索引不好
> 1. 数据库索引使用 B+树 ,插入和删除操作复杂度是 O(log(N)),代价高昂
> 2. 会给事务管理器带来额外开销
- innodb myisam 引擎比较
- 分库
- 分表
- 中间件
- 高可用集群
- varchar 字符截取规则

###通讯协议
- tcp
    - 三次握手
- udp
- http
    - 七层协议

###nginx
- 小流量
- 访问控制粒度

###加密
- https
- rsa
- md5

###防攻击
- xss
- csrf
- SYN Flood
- DDOS
- SQL注入
