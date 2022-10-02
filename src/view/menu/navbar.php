<div class="top-navbar">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none">
                        <span class="material-icons">arrow_back_ios</span>
                    </button>
					
					<a class="navbar-brand"> ComuniQ </a>
					
                    <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="material-icons">more_vert</span>
                    </button>

                    <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">   

                            <li class="nav-item">
                                <a class="nav-link" href="#">
								<span class="material-icons">apps</span>
								</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
								<span class="material-icons">person</span>
								</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="#">
								<span class="material-icons">settings</span>
								</a>
                            </li>

                            <li class="dropdown nav-item active">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                   <span class="material-icons">notifications</span>
								   <span class="notification"><?php 
                                    $conta_enviada = mysqli_query($conectar, "SELECT count(status) FROM noticiacao_comunicado WHERE email like '%$mail%' and status = 'Enviada'");
                                    $to_enviada = mysqli_fetch_assoc($conta_enviada);
                                    $conta_total = $to_enviada["count(status)"];
                                    echo $conta_total;
                                    ?></span>
                               </a>
                                <ul class="dropdown-menu">
                                    
                                <?php 

                                while($noti_pegar = mysqli_fetch_assoc($notificacao)){
                                  extract($noti_pegar);
                                  echo "
                                    <li>
                                      <a class = 'notifications' href='../modeloci/visualizacao.php?id=$id_notificacao' target='_blank'>$nome: enviou um comunicado com assunto: $assunto. <i class='fa-solid fa-circle-check text-success'></i> </a>
                                   </li>
                                  ";
                                }
                                 
                                ?>
                                   
                               
                                    
                                  
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
	    </div>