## Mysql

1. mysql 配置 
    - 字符集和排序   
        charset 选择 utf8mb4能存更多字节（4个字节）的字符类型比如表情【uf8最多是3个字节的字符】 collation  
        collation 选择 utf8mb4_general_ci （速度快） 和 utf8mb4_unicode_ci （更精确排序对比   比前者慢）
        strict  关闭严格模式
