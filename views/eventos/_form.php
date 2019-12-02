<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\TimePicker;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;




//$this->registerJsFile('@web/js/eventoScript.js', ['depends' => [yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$js = <<<JS
    cargarDatatable();
    cargarDatatableProgramacion();
    cargaDatatableInvitados();
JS;

$this->registerJs($js);

?>



<div class="eventos-form">
    <?php $model_invitados->evento_codigo = $model->evento_codigo;?>
    <?php $countInvitados = $model_invitados->getExisteInvitadosEvento();?>
    <?php $form = ActiveForm::begin(['id'=>'eventos']); ?>

    <?= Html::input('hidden','table_items_data','', $options=['class'=>'form-control', 'id'=>'table_items_data']) ?>
    <?= Html::input('hidden','table_invitados_data','', $options=['class'=>'form-control', 'id'=>'table_invitados_data']) ?>
    <?= Html::input('hidden','table_program_data','', $options=['class'=>'form-control', 'id'=>'table_program_data']) ?>
    <?= Html::input('hidden','id_item','', $options=['class'=>'form-control', 'id'=>'id_item']) ?>
    <?= Html::input('hidden','id_programa','', $options=['class'=>'form-control', 'id'=>'id_programa']) ?>
    <?= Html::input('hidden','item_url','', $options=['class'=>'form-control item_url', 'id'=>Url::to(['items-evento/get-items-evento','evento' => $model->evento_codigo])]) ?>
    <?= Html::input('hidden','programacion_url','', $options=['class'=>'form-control programacion_url', 'id'=>Url::to(['programacion-evento/get-programacion-evento','evento' => $model->evento_codigo])]) ?>
    <?= Html::input('hidden','staff_empleado_url','', $options=['class'=>'form-control staff_empleado_url', 'id'=>Url::to(['staff-evento/get-staff-empleado-evento'])]) ?>
    <?= Html::input('hidden','invitado_empleado_url','', $options=['class'=>'form-control invitado_empleado_url', 'id'=>Url::to(['invitados/get-invitado-empleado-evento'])]) ?>
    <?= Html::input('hidden','save_staff_empleado','', $options=['class'=>'form-control save_staff_empleado', 'id'=>Url::to(['staff-evento/save-staff-empleado-evento'])]) ?>
    <?= Html::input('hidden','save_invitado_empleado','', $options=['class'=>'form-control save_invitado_empleado', 'id'=>Url::to(['invitados/save-invitado-empleado-evento'])]) ?>

    <?= Html::input('hidden','id_staff','0', $options=['class'=>'form-control', 'id'=>'id_staff']) ?>
    <?= Html::input('hidden','id_invitado','0', $options=['class'=>'form-control', 'id'=>'id_invitado']) ?>

    <?= Html::input('hidden','evento_codigo',$model->evento_codigo, $options=['class'=>'form-control', 'id'=>'evento_codigo']) ?>
    <?= Html::input('hidden','file_url','', $options=['class'=>'form-control file_url', 'id'=>Url::to(['eventos/preview-invitados'])]) ?>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#datos">Datos e Ítems</a></li>
            <li><a data-toggle="tab" href="#programacion">Programación</a></li>
            <li><a data-toggle="tab" href="#invitados">Invitados</a></li>
            <li><a data-toggle="tab" href="#staff">Staff</a></li>

        </ul>

        <div class="tab-content">
            <div id="datos" class="tab-pane fade in active">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])->label('Nombre') ?>
                    </div>

                    <div class="col-12 col-md-6">
                         <?=
                            $form->field($model, 'Estado_codigo')->widget(SwitchInput::classname([
                                'name' => 'Estado_codigo',
                                'pluginOptions' => [
                                    'onText' => 'Si',
                                    'offText' => 'No',
                                ]
                            ]))->label('Estado');
                           
                        ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?=  $form->field($model, 'sede')->widget(Select2::classname(),[   
                                                'data' => ArrayHelper::map($model_sedes->getSedes(), "Codigo","Descripcion"),
                                                'language' => 'es',
                                                'options' =>[  
                                                                'placeholder' => 'Seleccione ',
                                                                'id'=>'sede'
                                                            ],
                                                'pluginOptions' =>  [
                                                                        'allowClear' => true,
                                                                    ]
                            ])->label('Sede');
                        ?>

                    </div>
                    <div class="col-12 col-md-6">
                        <?=  $form->field($model, 'ubicacion_sede')->widget(DepDrop::classname(),[
                                             'options' => ['id'=>'ubicacion_sede'],
                                             'type' => DepDrop::TYPE_SELECT2,
                                             'pluginOptions'=>[
                                                'initialize'=>true,
                                                 'depends'=>['sede'],
                                                 'placeholder' => 'Select...',
                                                 'url' => Url::to(['sede-ubicacion/get-ubicacion'])
                                             ]
                                        ])->label('Ubicación');
                        ?>
                    </div>
                
                    <div class="col-12" style="text-align:center;margin-top:20px">
                        <label>ÍTEMS DEL EVENTO</label>
                        <hr  size="2" width="100%" style='margin-top:0px; margin-bottom: 20px;border: 0;border-top: 1px solid #172d44;'>
                    </div>
                    <div class="col-12 col-md-4">

                        <label>Item</label>
                        <?= Select2::widget([   
                                                'name'=>'item_codigo',
                                                'data' => ArrayHelper::map($model_itemsCatalogo->getItems(), "Codigo","Descripcion"),
                                                'language' => 'es',
                                                'options' =>[  
                                                                'placeholder' => 'Seleccione ',
                                                                'id'=>'item_codigo'
                                                            ],
                                                'pluginOptions' =>  [
                                                                        'allowClear' => true,
                                                                    ]
                            ]) 
                        ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?= $form->field($model, 'cantidad')->textInput() ?>
                    </div>

                    <div class="col-12 col-md-2">
               
                        <?= $form->field($model, 'estado_item')->checkbox(array(
                                            'label'=>'',
                                            'labelOptions'=>array('style'=>'padding:5px;'),
                                            'value' => '1', 'uncheckValue'=>'0'
                                            ))
                                            ->label('Estado') 
                        ?>
                    </div>

                    <div class="col-12 col-md-2">
                        <br>
                        <?= Html::button('Agregar', array('onclick' => 'js:agregarItems()','class' => 'btn btn-primary'));?>
                    </div>
                    <div class="col-12">
                        <table id="table_items" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <br>
                    </div>
                   
                   
                </div>
            </div>
            <div id="programacion" class="tab-pane fade">
                <div class="row justify-content-center">
                    
                    <div class="col-12 col-md-2">
                        <label>Fecha Inicial</label>
                        <?php
                            echo DatePicker::widget([
                                        'name'=>'dateini',
                                        'id'=>'dateini',
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                        'autoclose'=>true,
                                        'todayBtn' => true,
                                        'format' => 'dd/mm/yyyy',
                                        ],
                                        'options'=>['autocomplete'=>'off']

                                    ]);
                        ?>
                    </div>
                    <div class="col-12 col-md-2">
                        <label>Hora Inicio</label>
                        <?php

                            echo TimePicker::widget([
                                'name' => 'timeini',
                                'id'=>'timeini',
                                "pluginOptions" => ["showMeridian" => false],
                                'addon'=>'<i class="far fa-clock"></i>',
                                'addonOptions' => [
                                    'asButton' => true,
                                ]
                            ]);
                        ?>                
                    </div>
                    <div class="col-12 col-md-2">
                        <label>Fecha Final</label>
                        <?php
                            echo DatePicker::widget([
                                        'name'=>'datefin',
                                        'id'=>'datefin',
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                        'autoclose'=>true,
                                        'todayBtn' => true,
                                        'format' => 'dd/mm/yyyy',
                                        ],
                                        'options'=>['autocomplete'=>'off']

                                    ]);
                        ?>
                    </div>
                    <div class="col-12 col-md-2">
                        <label>Hora Final</label>
                        <?php
                            echo TimePicker::widget([
                                'name' => 'timefin',
                                'id' => 'timefin',
                                'bsVersion'=>'3.x',
                                "pluginOptions" => ["showMeridian" => false],
                                'addon'=>'<i class="far fa-clock"></i>',
                                'addonOptions' => [
                                    'asButton' => true,
                                ],
                            ]);
                        ?>
                    </div>

                    <div class="col-12 col-md-4">
                        <br>
                        <?= Html::button('Agregar', array('onclick' => 'js:agregarProgramacion()','class' => 'btn btn-primary'));?>
                    </div>
                    <div class="col-12" style="text-align:center;margin-top:20px">
                        <label>PROGRAMACIÓN DEL EVENTO</label>
                        <hr  size="2" width="100%" style='margin-top:0px; margin-bottom: 20px;border: 0;border-top: 1px solid #172d44;'>
                    </div>
                    <div class="col-12">
                        <table id="table_programacion" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Fecha Inicial</th>
                                    <th>Hora Inicial</th>
                                    <th>Fecha Final</th>
                                    <th>Hora Final</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                        <br>
                    </div>

                    
                </div>
            </div>
            <div id="invitados" class="tab-pane fade">
                <div class="row justify-content-center" id='invitados_preview'>
                    <?php if( $countInvitados == false){?>
                        <div class="col-12">
                            <?= $form->field($model, 'file')->fileInput()->label('Carga de Invitados') ?>
                        </div>
                        <div class="col-12">
                            <?= Html::button('Cargar', array('onclick' => 'js:uploadFile()','class' => 'btn btn-primary'));?>
                        </div>

                    
                    <div class="col-12" style="text-align:center;margin-top:20px">
                        <label>INVITADOS DEL EVENTO</label>
                        <hr  size="2" width="100%" style='margin-top:0px; margin-bottom: 20px;border: 0;border-top: 1px solid #172d44;'>
                    </div>
                        <div class="col-12">
                            <table id="table_invitados" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Número de Documento</th>
                                        <th>Nombre</th>
                                        <th>Apellido Materno</th>
                                        <th>Apellido Paterno</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    <?php }?>
                </div>
                <div class="row justify-content-center" id='invitados_gridview'>
                    <?php if($countInvitados == true){?>
                        <div class="col-12 col-md-5">
                            <?=  $form->field($model, 'invitado_empleado')->widget(Select2::classname(),[   
                                                    'data' => ArrayHelper::map($model->getEmpleados(), "Codigo","Descripcion"),
                                                    'language' => 'es',
                                                    'options' =>[  
                                                                    'placeholder' => 'Seleccione ',
                                                                    'id'=>'invitado_empleado'
                                                                ],
                                                    'pluginOptions' =>  [
                                                                            'allowClear' => true,
                                                                        ]
                                ])->label('Empleado Invitado');
                            ?>

                        </div>
                        <div class="col-12 col-md-5">
                            <?=  $form->field($model, 'estado_invitado_empleado')->widget(Select2::classname(),[   
                                                    'data' =>[1=>'activo',2=>'desactivado'],
                                                    'language' => 'es',
                                                    'options' =>[  
                                                                    'placeholder' => 'Seleccione ',
                                                                    'id'=>'estado_invitado_empleado'
                                                                ],
                                                    'pluginOptions' =>  [
                                                                            'allowClear' => true,
                                                                        ]
                                ])->label('Estado');
                            ?>
                        </div>
                        <div class="col-12 col-md-2">
                            <br>
                            <?= Html::button('Guardar', array('onclick' => 'js:saveEmpleadoInvitado()','class' => 'btn btn-primary'));?>
                        </div>
                        <div class="col-12">
                            <?php Pjax::begin(['id'=>'invitados_evento','enablePushState'=>false,'timeout'=>5000]); ?>
                                <?= 
                                    GridView::widget([
                                        'dataProvider' => $model->getInvitadosEvento($model->evento_codigo),
                                        'columns' => 
                                        [
                                            [
                                                'attribute'=>'nombre',
                                                'label' => 'Nombre',
                                            ],
                                            [
                                                'attribute'=>'apellido_materno',
                                                'label' => 'Apellido Materno',
                                            ],
                                            [
                                                'attribute'=>'apellido_paterno',
                                                'label' => 'Apellido Paterno',
                                            ],
                                            [
                                                'attribute'=>'activo',
                                                'label' => 'Estado',
                                            ],
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{update}',
                                                'buttons' => [
                                                    'update' => function ($url, $model, $key){
                                                        return Html::a
                                                                        (   
                                                                           '<span class="glyphicon glyphicon-pencil" title="Editar"></span>', 
                                                                            '', 
                                                                            [
                                                                                //'data-target'=>'#modalDesAct',
                                                                                //'data-toggle'=>'modal',
                                                                                //'class'=>'desAct',
                                                                                //'style'=>$style,
                                                                                'onclick'=>'selecionarEmpleadoInvitado('.$model['invitado_codigo'].')'
                                                                                //'id'=>Url::to(['campanas/detalle-campana','cod_campana' => $model->Cod_Campana,'estado' => $model->Estado])
                                                                            ]
                                                                        );
                                                    }
                                                ],
                                            ],

                                          
                                        ],
                                    ]) 
                                ?>
                            <?php yii\widgets\Pjax::end() ?>
                        </div>
                    <?php }?>
                    
                </div>


            </div>
            <div id="staff" class="tab-pane fade">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4">
                        <?=  $form->field($model, 'staff_empleado')->widget(Select2::classname(),[   
                                                'data' => ArrayHelper::map($model->getEmpleadosRolStaff($model->evento_codigo), "Codigo","Descripcion"),
                                                'language' => 'es',
                                                'options' =>[  
                                                                'placeholder' => 'Seleccione ',
                                                                'id'=>'staff_empleado'
                                                            ],
                                                'pluginOptions' =>  [
                                                                        'allowClear' => true,
                                                                    ]
                            ])->label('Empleado');
                        ?>

                    </div>
                    <div class="col-12 col-md-4">
                        <?=  $form->field($model, 'staff_tarea')->widget(Select2::classname(),[   
                                                'data' => ArrayHelper::map($model->getTareas(), "Codigo","Descripcion"),
                                                'language' => 'es',
                                                'options' =>[  
                                                                'placeholder' => 'Seleccione ',
                                                                'id'=>'staff_tarea'
                                                            ],
                                                'pluginOptions' =>  [
                                                                        'allowClear' => true,
                                                                    ]
                            ])->label('Tareas');
                        ?>
                    </div>
                    <div class="col-12 col-md-3">
                        <?=  $form->field($model, 'estado_staff_empleado')->widget(Select2::classname(),[   
                                                'data' =>[1=>'activo',2=>'desactivado'],
                                                'language' => 'es',
                                                'options' =>[  
                                                                'placeholder' => 'Seleccione ',
                                                                'id'=>'estado_staff_empleado'
                                                            ],
                                                'pluginOptions' =>  [
                                                                        'allowClear' => true,
                                                                    ]
                            ])->label('Estado');
                        ?>
                    </div>
                    <div class="col-12 col-md-1">
                        <br>
                        <?= Html::button('Guardar', array('onclick' => 'js:saveEmpleadoStaff()','class' => 'btn btn-primary'));?>
                    </div>
                     <div class="col-12" style="text-align:center;margin-top:20px">
                        <label>STAFF DEL EVENTO</label>
                        <hr  size="2" width="100%" style='margin-top:0px; margin-bottom: 20px;border: 0;border-top: 1px solid #172d44;'>
                    </div>
                    <div class="col-12">
                        <?php Pjax::begin(['id'=>'staff_evento','enablePushState'=>false,'timeout'=>5000]); ?>
                            <?= 
                                GridView::widget([
                                    'dataProvider' => $model->getStaffEvento($model->evento_codigo),
                                    'columns' => 
                                    [
                                        [
                                            'attribute'=>'nombre',
                                            'label' => 'Nombre',
                                        ],
                                        [
                                            'attribute'=>'apellido_materno',
                                            'label' => 'Apellido Materno',
                                        ],
                                        [
                                            'attribute'=>'apellido_paterno',
                                            'label' => 'Apellido Paterno',
                                        ],
                                        [
                                            'attribute'=>'tarea',
                                            'label' => 'Tarea',
                                        ],
                                        [
                                            'attribute'=>'activo',
                                            'label' => 'Estado',
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'buttons' => [
                                                'update' => function ($url, $model, $key){
                                                    //var_dump('editar'.$model->staff_codigo);
                                                    return Html::a
                                                                    (   
                                                                       '<span class="glyphicon glyphicon-pencil" title="Editar"></span>', 
                                                                        '', 
                                                                        [
                                                                            //'data-target'=>'#modalDesAct',
                                                                            //'data-toggle'=>'modal',
                                                                            //'class'=>'desAct',
                                                                            //'style'=>$style,
                                                                            'onclick'=>'selecionarEmpleadoStaff('.$model['staff_codigo'].')'
                                                                            //'id'=>Url::to(['campanas/detalle-campana','cod_campana' => $model->Cod_Campana,'estado' => $model->Estado])
                                                                        ]
                                                                    );
                                                }
                                            ],
                                        ],

                                      
                                    ],
                                ]) 
                            ?>
                        <?php yii\widgets\Pjax::end() ?>
                    </div>
                </div>

                
            </div>
        </div>        
    </div>
    <br>
    <div class="form-group" style="text-align: center">
        <?= Html::submitButton('Aceptar', ['class' => 'btn btn-primary','id'=>'btn_guardar', 'name'=>'btn_guardar']) ?>
        <?= Html::button('Cancelar', array('onclick' => 'js:document.location.href="index"','class' => 'btn btn-secondary'));?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

