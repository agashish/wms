<div class="wrapper animated fadeInDown">
		<div class="panel overflow-hidden">
			<div class="bg-jij-600 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
				<i class="ion-log-in margin-right-5"></i> Sign In to WMS				
			</div>
			
            <?php				
                print $this->form->create( 'User', array( 'class'=>'form-horizontal', 'type'=>'post','id'=>'userLogin' ) );                
            ?>
            
				<div class="alert bg-jij-600 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">Please sign in to WMS dashboard</div>
				<div class="box-body padding-md bg-grey-100">
					<?php
						print $this->Session->flash();
					?>
					<div class="form-group">
                        <?php
                            print $this->form->input( 'User.username', array( 'type'=>'text','div'=>false, 'placeholder'=>'Username', 'label'=>false,'class'=>'form-control input-lg', 'required'=>false ) );    
                        ?> 
					</div>
					
                    <div class="form-group">
                        <?php
                            print $this->form->input( 'User.password', array( 'type'=>'password','div'=>false, 'placeholder'=>'Password', 'label'=>false,'class'=>'form-control input-lg', 'required'=>false ) );    
                        ?> 
					</div>
					
					<div class="form-group margin-top-20">						
                        <?php
                            print $this->form->input( 'User.user_remember', array( 'type'=>'checkbox', 'checked'=>'checked', 'div'=>false, 'placeholder'=>'Password', 'label'=>false,'class'=>'js-switch', 'required'=>false ) );    
                        ?>
                        <label for="checkbox" class="font-size-12 normal margin-left-10">Remember Me</label>
					</div>       
					
                    <?php
                        echo $this->Form->button(' Sign In', array(
                            'type' => 'submit',
                            'escape' => true,
                            'class'=>'btn btn-dark bg-light-green-500 padding-10 btn-block color-white'
                             ));	
                    ?>
				</div>
			
			<div class="panel-footer padding-md no-margin no-border bg-jij-600 text-center color-white">&copy; 2015 WMS by JIJ Group.</div>
		</div>
	</div>