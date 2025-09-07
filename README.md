# ENGLISH-LIKED
## 介绍
<p align="center">
  <img alt="ENGLISH-LIKED " style="margin-bottom:10px;" src="./Word.png"><br>
 <img alt="GitHub forks" src="https://img.shields.io/github/forks/CHEN-EXE/ENGLISH-LIKED">
 <img alt="GitHub Repo stars" src="https://img.shields.io/github/stars/CHEN-EXE/ENGLISH-LIKED">
<br>
  <img alt="ENGLISH-LIKED LOGO" src="./EN-LOGO.png">
</p><br>


English word spelling and dictation system built on PHP.
禁止用于商业用途！
## 代码未上传，烦请耐心等待。
## 介绍
ENGLISH-LIKED 是一个基于php构建的英语单词听写系统，可通过 PHP 个性化单词数量单词内容，配置单元，配置页面。
## 部署
无需执行任何控制台操作，只需要2步骤，您可能需要为您的服务器部署***宝塔面板**或者***nginx,php或者apache***，php是必不可少的，系统依靠php服务，建议安装php**7.4**，以避免不必要的麻烦。<br>
### 1. 下载仓库文件<br>
建议通过Git Clone下载，当然你也可以用zip解压。
```bash
git clone https://github.com/CHEN-EXE/ENGLISH-LIKED.git
```
### 2.访问您的站点
如果服务成功运行，您会在网页上看到一个 ***课程出错了
当前单元课程不存在***。

## 单词配置
### 2.配置单词数据
我们在/part/目录预置了一个单词模板php文件，其中，``$lesson``变量是指单元名称，可任意填写。<br>
``$jsonString``变量是单词数据列表。里面有一个``questions``，指数据列。其中含json。<br>
下面是一个json示例
```json
  "questions": [
        {
            "chinese": "[中文]",
            "english": "[英文]"
        }
]
```
像这样，如果您需要新增单词:
```json
  "questions": [
        {
            "chinese": "[中文]",
            "english": "[英文]"
        },
        {
            "chinese": "[中文1]",
            "english": "[英文1]"
        }
]
```
需要注意的是，在最后一个单词数据列，``}``后面的逗号不需要加。<br>
如果系统提示配置出错，请检查一下json。
### 系统配置
您可以在目录下看到``config.json``，这是一个json文件，里面包含了单元列表，您可以访问``?part=home``查看可用的课程列表。
```json
{
  "unit": [
    {
      "taskId": [顺序，从1开始，第二个就写2，后面的依次。],
      "part": "[单元名称]",
      "description": "[这里是介绍]",
      "WordNumber": "[单词数量，可选]",
      "site":"?part=[单元引用]"
    },
        {
      "taskId": 2,
      "part": "UNIT 1",
      "description": "HI,NAME",
      "WordNumber": "10",
      "site":"?part=u1"
    }
  ]
}
```
同单词文件配置，在最后一个数据列，``}``后面的逗号不需要加。<br>
如果系统提示配置出错，检查它和单词文件。
### 主入口文件修改
只修改单词文件和系统配置文件是无法展示单词的。所以你需要修改主入口文件，虽然它很长。<br>
你大概会从它的第12行看到:
```php
case "[单元引用]":
    require "./part/[单词文件名称].php";
    break;
```
如果你需要新增单元引用，需要在他的下面再加一个同样的代码，并且修改内容。<br>
后续可能会支持系统配置文件直接转单元引用入口。<br>
如果您需要访问(例子)您在主入口新增的单元引用``U1``入口，您需要访问/index.php?part=``U1``，并检查您的单词文件目录是否设置正确，如果正确的话你可能会看到一个单词听写页面，展示了单词的中文形式，支持朗读。
<br>那么恭喜你，您已成功配置好系统。
### 文档还在完善中。
