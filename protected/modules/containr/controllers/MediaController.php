<?php

class MediaController extends ContainrController
{

	public function actions()
    {
        return array(
            'upload'=>array(
                'class'=>'xupload.actions.XUploadAction',
                'path' =>Yii::app() -> getBasePath() . "/../_lib/uploads",
                'publicPath' => Yii::app() -> getBaseUrl() . "/_lib/uploads",
            ),
        );
    }

	public function actionIndex()
	{
		Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;

		$this->breadcrumbs=array(
			ucfirst($this->id),
			ucfirst($this->action->id),
		);

		$this->render('index', array('model' => $model));
	}

	public function actionDelete() {

		ContainrMedia::model()->deleteByPK($_GET['id']);
		$this->redirect(Yii::app()->createUrl('containr/media/index'));
	}

	public function actionUpdate()
	{
		$this->breadcrumbs=array(
			ucfirst($this->id),
			ucfirst($this->action->id),
		);

		$model = ContainrMedia::model()->findByPK($_GET['id']);

		// get advanced media information
		if(strpos($model->type,"image") !== false) {
			$image = new Image($_SERVER["DOCUMENT_ROOT"].$model->path.'/'.$model->filename);
			$model->imageWidth = $image->width;
			$model->imageHeight = $image->height;
		}

		if(isset($_GET['crop'])){
			$ratio = (4/3);

			if($model->imageWidth > $model->imageHeight) {
				$newWidth = $model->imageHeight * $ratio;

				$image->crop($newWidth,$image->height);
				$image->save();
				$this->redirect(Yii::app()->createUrl('containr/media/update',array('id'=>$_GET['id'])));
			}
		}

		if(isset($_GET['watermark'])){

			// Set ratio
			$ratio = (4/3);

			// Dimension calculation
			if($image->width > $image->height || $image->width == $image->height) {

				// check if it's already in correct ratio
				if(($image->width / $image->height) <> $ratio){
					$newHeight = $image->height * $ratio;
					$newWidth = $image->width;
				} else {
					$newWidth = $image->width;
					$newHeight = $image->height;
				}
			} elseif ($image->width < $image->height) {
				$newWidth = $image->width * $ratio;
				$newHeight = $image->height;
			} else {
				$newWidth = $image->width;
				$newHeight = $image->height;
			}

			// Color definition
			$color = array(255, 255, 255);

			// First watermark it
			$image->watermark('www.holz-objekte.org', 10);
			$image->save();

			// Then add it to ratio layer
			$image->addlayer($color,$newWidth,$newHeight);

			$image->save();
			$this->redirect(Yii::app()->createUrl('containr/media/update',array('id'=>$_GET['id'])));
		}

		$this->render('update', array('model' => $model));
	}

	public function actionLibrary(){
		$this->layout = 'mediamodal';

		$this->render('library',array('hideSelector'=>'false'));
	}

	public function actionSelector(){
		$this->layout = 'mediamodal';

		$this->render('library', array('hideSelector'=>'true'));
	}

	public function actionLinker(){
		$this->layout = 'mediamodal';

		$this->render('linker');
	}

	public function actionGetmedia()
	{
		Yii::import("application.modules.containr.extensions.GbImageHelper");


		$size = (isset($_GET['msize'])) ? $_GET['msize'] : 'thumb';
		$mId = $_GET['mid'];
		$src = ContainrMedia::model()->getMediaSrc($mId,$size);


		Yii::app()->controller->widget('application.modules.containr.extensions.GbImageHelper', array(
	    	'imageId' => $mId,
	    	'size' => $size,
	    	'processOnly' => true
		));



		$image = new Image($_SERVER['DOCUMENT_ROOT'].$src);
		$image->render();

	}

	public function actionUpload(){
		Yii::import( "xupload.models.XUploadForm" );
	    //Here we define the paths where the files will be stored temporarily
	    $path = realpath( Yii::app( )->getBasePath( )."/../_lib/uploads" )."/";
	    $publicPath = Yii::app( )->getBaseUrl( )."/_lib/uploads/";

	    //This is for IE which doens't handle 'Content-type: application/json' correctly
	    header( 'Vary: Accept' );

	    if( isset( $_SERVER['HTTP_ACCEPT'] ) && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
	        header( 'Content-type: application/json' );
	    } else {
	        header( 'Content-type: text/plain' );
	    }

	    //Here we check if we are deleting and uploaded file
	    if( isset( $_GET["_method"] ) ) {
	        if( $_GET["_method"] == "delete" ) {
	            if( $_GET["file"][0] !== '.' ) {
	                $file = $path.$_GET["file"];
	                if( is_file( $file ) ) {
	                    unlink( $file );
	                }
	            }
	            echo json_encode( true );
	        }
	    } else {
	        $model = new XUploadForm;
	        $model->file = CUploadedFile::getInstance( $model, 'file' );
	        //We check that the file was successfully uploaded
	        if( $model->file !== null ) {
	            //Grab some data
	            $model->mime_type = $model->file->getType( );
	            $model->size = $model->file->getSize( );
	            $model->name = $model->file->getName( );

	            //(optional) Generate a random name for our file
	            $filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
	            $filename .= ".".$model->file->getExtensionName( );

	            if( $model->validate( ) ) {
	                //Move our file to our temporary dir
	                $model->file->saveAs( $path.$filename );
	                chmod( $path.$filename, 0777 );
	                //here you can also generate the image versions you need
	                //using something like PHPThumb


	                //Now we need to save this path to the user's session
	                if( Yii::app( )->user->hasState( 'images' ) ) {
	                    $userImages = Yii::app( )->user->getState( 'images' );
	                } else {
	                    $userImages = array();
	                }

	                $userImages[] = array(
	                    "path" => $path.$filename,
	                    //the same file or a thumb version that you generated
	                    "thumb" => $path.$filename,
	                    "filename" => $filename,
	                    'size' => $model->size,
	                    'mime' => $model->mime_type,
	                    'name' => $model->name,
	                );

	                Yii::app( )->user->setState( 'images', $userImages );

	                //Now we need to tell our widget that the upload was succesfull
	                //We do so, using the json structure defined in
	                // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
	                echo json_encode( array( array(
	                        "name" => $model->name,
	                        "type" => $model->mime_type,
	                        "size" => $model->size,
	                        "url" => $publicPath.$filename,
	                        "thumbnail_url" => $publicPath."thumbs/$filename",
	                        "delete_url" => $this->createUrl( "upload", array(
	                            "_method" => "delete",
	                            "file" => $filename
	                        ) ),
	                        "delete_type" => "POST"
	                    ) ) );
	            } else {
	                //If the upload failed for some reason we log some data and let the widget know
	                echo json_encode( array(
	                    array( "error" => $model->getErrors( 'file' ),
	                ) ) );
	                Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
	                    CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
	                );
	            }
	        } else {
	            throw new CHttpException( 500, "Could not upload file" );
	        }
		}
	}

	public function actionUploadlib(){
		Yii::import( "xupload.models.XUploadForm" );
	    //Here we define the paths where the files will be stored temporarily
	    $path = realpath( Yii::app( )->getBasePath( )."/../_lib/uploads" )."/";
	    $publicPath = Yii::app( )->getBaseUrl( )."/_lib/uploads/";

	    //This is for IE which doens't handle 'Content-type: application/json' correctly
	    header( 'Vary: Accept' );

	    if( isset( $_SERVER['HTTP_ACCEPT'] ) && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
	        header( 'Content-type: application/json' );
	    } else {
	        header( 'Content-type: text/plain' );
	    }

	    //Here we check if we are deleting and uploaded file
	    if( isset( $_GET["_method"] ) ) {
	        if( $_GET["_method"] == "delete" ) {
	            if( $_GET["file"][0] !== '.' ) {
	                $file = $path.$_GET["file"];
	                if( is_file( $file ) ) {
	                    unlink( $file );
	                }
	            }
	            echo json_encode( true );
	        }
	    } else {
	        $model = new XUploadForm;
	        $model->file = CUploadedFile::getInstance( $model, 'file' );
	        //We check that the file was successfully uploaded
	        if( $model->file !== null ) {
	            //Grab some data
	            $model->mime_type = $model->file->getType( );
	            $model->size = $model->file->getSize( );
	            $model->name = $model->file->getName( );

	            //(optional) Generate a random name for our file
	            $filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
	            $filename .= ".".$model->file->getExtensionName( );

	            if( $model->validate( ) ) {
	                //Move our file to our temporary dir
	                $model->file->saveAs( $path.$filename );
	                chmod( $path.$filename, 0777 );

	                //Resolve the final path for our images
			        $pathFinal = str_replace("/protected","",$path.strftime("%d%m%y",time())."/");

			        //Create the folder and give permissions if it doesnt exists
			        if( !is_dir( $pathFinal ) ) {
			            mkdir( $pathFinal );
			            chmod( $pathFinal, 0777 );
			        }

	            	// move the file
	                if( rename( $path.$filename, $pathFinal.$filename ) ) {
	                    chmod( $pathFinal.$filename, 0777 );

                        $cntMedia = new ContainrMedia();
	                    $cntMedia->filename =$filename;
	                    $cntMedia->description = $model->name;
	                    $cntMedia->path = str_replace(str_replace("/protected","",Yii::app( )->getBasePath( )),"",$pathFinal);
	                    $cntMedia->type = $model->mime_type;
	                    $cntMedia->save();
	                }

	                //Now we need to tell our widget that the upload was succesfull
	                //We do so, using the json structure defined in
	                // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
	                echo json_encode( array( array(
	                        "name" => $model->name,
	                        "type" => $model->mime_type,
	                        "size" => $model->size,
	                        "url" => $publicPath.$filename,
	                        //"thumbnail_url" => $publicPath."thumbs/$filename",
	                        "delete_url" => $this->createUrl( "upload", array(
	                            "_method" => "delete",
	                            "file" => $filename
	                        ) ),
	                        "delete_type" => "POST"
	                    ) ) );
	            } else {
	                //If the upload failed for some reason we log some data and let the widget know
	                echo json_encode( array(
	                    array( "error" => $model->getErrors( 'file' ),
	                ) ) );
	                Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
	                    CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
	                );
	            }
	        } else {
	            throw new CHttpException( 500, "Could not upload file" );
	        }
		}
	}
}
