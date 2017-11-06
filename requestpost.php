<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>

<style>

.sempostagem{
	background: #fff;
	height: 50px;
	text-align: center;
	border-radius: 5px;
}

.sempostagem p{
	font-size: 25px;
	padding: 10px;
}

</style>

<?php
$coments = DBRead( 'post', "WHERE id ORDER BY id DESC" );
if (!$coments)
echo '<div class="sempostagem"><p>Sem postagem :/</p></div>';
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>
	

<div class="people-status-div">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40" style="border-radius:50%;"></a>
										</li>

										<li class="name"><a href="profile.php?id=<?php echo $people['id']?>"><span class="bold"> <?php echo $people['nome']?> <?php echo $people['sobname']?> - <?php echo $people['user']?> </span></a>

														<ul class="scope-time-ul">
															<li><a href="#" class="su-time"><?php echo $coment['tim']?></a></li>
															<li><a href="#"><span class="fa fa-globe globe-icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Shared with: Public"></span></a></li>
														</ul>
										</li>
									</ul>

									<div class="user-status">
											<article>
													<p class="eooq">
                                                    <?php 
                                                    $emotions = array(':)', ':@', '8)', ':D', ':3', ':(', ';)', ':O', ':o', ':P', ':p', '<3');
                                                    $imgs = array(
                                                        '<img id="emoticon" src="/static/img/emotions/nice.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/angry.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/cool.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/happy.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/sad.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/right.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/heart.png"/>'
                                                    );
                                                    $msg = str_replace($emotions, $imgs, $coment['texto']);
                                                    echo $msg;
                                                    ?>
													</p>
											</article>
									</div> <!-- End User Status -->
									
									<div class="people-reaction-activity">
											<ul class="r-activity-list">
												<li><span class="fb_icon like"></span><a href="#">Curtir</a></li>
												<li><span class="fb_icon share"></span><a href="#">Compartilhar</a></li>
											</ul>
									</div> <!-- End People reaction Activity -->
								</li>
					</div>


    <?php endforeach;endforeach;?>