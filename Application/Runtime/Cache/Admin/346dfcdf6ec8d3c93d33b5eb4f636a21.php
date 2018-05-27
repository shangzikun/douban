<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/admin/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/admin/assets/css/font-awesome.min.css" rel="stylesheet">
<!-- Data Tables -->
<link href="/Public/admin/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/Public/admin/assets/css/animate.min.css" rel="stylesheet">
<link href="/Public/admin/assets/css/style.min.css" rel="stylesheet"><base target="_blank">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>编辑商品信息</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" action="<?php echo U('admin/goods/doAdd');?>" method="post" target="_self" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">价格</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">简介</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="desc">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="content">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标签</label>
                                <div class="col-sm-10">
                                    <?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="checkbox i-checks">
                                        <label>
                                            <input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="tags[]"><span style="border:1px solid <?php echo ($vo["color"]); ?>"><?php echo ($vo['name']); ?></span> 
                                        </label>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                    <button class="btn btn-white" type="reset">取消</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script src="/Public/admin/assets/js/jquery.min.js"></script>
<script src="/Public/admin/assets/js/bootstrap.min.js"></script>
<script src="/Public/admin/assets/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/admin/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/admin/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/admin/assets/js/content.min.js"></script>
</body>

</html>