<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "empleados".
 *
 * @property integer $Empleado_Codigo
 * @property string $Empleado_Carnet
 * @property integer $Empleado_Jefe
 * @property double $Usuario_Id
 * @property string $Usuario_Nick
 * @property integer $Ccto_Codigo
 * @property string $Ccr_Codigo
 * @property string $Ccb_Codigo
 * @property string $Empleado_Apellido_Paterno
 * @property string $Empleado_Apellido_Materno
 * @property string $Empleado_Nombres
 * @property string $Empleado_Fecha_Nacimiento
 * @property string $Empleado_Fecha_Ingreso
 * @property string $Empleado_Nombre_Via
 * @property string $Empleado_Nro
 * @property string $Empleado_Pais_Nacimiento
 * @property string $Empleado_Dpto_Nacimiento
 * @property string $Empleado_Prov_Nacimiento
 * @property string $Empleado_Dist_Nacimiento
 * @property string $Empleado_Dpto_Residencia
 * @property string $Empleado_Prov_Residencia
 * @property string $Empleado_Dist_Residencia
 * @property string $Empleado_sexo
 * @property string $Empleado_Tlf
 * @property string $Empleado_Tlf_Referencia
 * @property string $Empleado_Preguntar_Por
 * @property string $Empleado_Celular
 * @property integer $Empleado_Estado_Civil
 * @property string $Empleado_Email
 * @property string $Empleado_Dni
 * @property string $Empleado_Clave_Acceso
 * @property string $Empleado_Ruc
 * @property string $Empleado_Lib_Militar
 * @property string $Empleado_Num_Seguro
 * @property integer $Empleado_Nivel
 * @property integer $Empleado_trasvase
 * @property integer $Empleado_Responsable_Area
 * @property string $Empleado_Foto
 * @property integer $Moneda_Codigo
 * @property integer $Postulante_Codigo
 * @property integer $Empleado_activo
 * @property integer $Estado_Codigo
 * @property string $Empleado_Fecha_Reg
 * @property string $EMPLEADO_CPSA_USUARIO
 * @property string $EMPLEADO_CPSA_PASSWORD
 * @property integer $Empleado_Clave_Modificada
 * @property integer $turno_codigo
 * @property integer $Empleado_dependientes
 * @property integer $Empleado_hijos_mayores
 * @property integer $Retencion_judicial
 * @property double $Retencion_judicial_cantidad
 * @property integer $Local_Codigo
 * @property string $urba_nombre
 * @property string $empleado_interior
 * @property integer $Rqto_Codigo
 * @property string $empleado_fecha_modifica
 * @property string $MODALIDAD_FORMATIVA
 * @property string $regimen_fecha_inscripcion
 * @property string $MODALIDAD_PAGO
 * @property string $TDI_CODIGO
 * @property string $CODIGO_NACIONALIDAD
 * @property string $CODIGO_ZONA
 * @property string $NOMBRE_ZONA
 * @property string $NIVEL_ESTUDIO
 * @property string $TIPO_ACTIVIDAD
 * @property string $TRABAJADOR_TIPO
 * @property string $DISCAPACIDAD
 * @property string $HORARIO_NOCTURNO
 * @property string $SINDICALIZADO
 * @property string $SITUACION_ESPECIAL
 * @property integer $CODIGO_REGIMEN
 * @property string $FECHA_INSCRIPCION_OTRO
 * @property string $REGIMEN_ALTERNATIVO
 * @property string $JORNADA_MAXIMA
 * @property string $IPSS_VIDA
 * @property string $Empleado_ultima_fecha_cese
 * @property string $referencia_direccion
 * @property string $Agrupacion_id
 * @property integer $tc_codigo
 * @property integer $turno_extendido
 * @property string $Empleado_Telefono_Codigo
 * @property integer $tipo_extension_codigo
 */
class EmpleadoLoginAcceso extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public $empresa_codigo     = "1";
    public $empresa_activo     = "";
    public $empresa_db         = "";
    public $empresa_descripcion= "";
    public $empresa_direccion  = "";
    public $sistema_codigo     = "51";
    public $empresa_login      = "";
    public $empresa_password   = "";
    public $empresa_url        = "";
    public $rol_codigo         = "";

    public $dsMenuChild = array();

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_zeus');
    }

   
        public function rules()
    {
        return [
            [['Empleado_Codigo'], 'required'],
            [['Empleado_Codigo', 'Empleado_Jefe', 'Ccto_Codigo', 'Empleado_Estado_Civil', 'Empleado_Nivel', 'Empleado_trasvase', 'Empleado_Responsable_Area', 'Moneda_Codigo', 'Postulante_Codigo', 'Empleado_activo', 'Estado_Codigo', 'Empleado_Clave_Modificada', 'turno_codigo', 'Empleado_dependientes', 'Empleado_hijos_mayores', 'Retencion_judicial', 'Local_Codigo', 'Rqto_Codigo', 'CODIGO_REGIMEN'], 'integer'],
            [['Empleado_Carnet', 'Usuario_Nick', 'Ccr_Codigo', 'Ccb_Codigo', 'Empleado_Apellido_Paterno', 'Empleado_Apellido_Materno', 'Empleado_Nombres', 'Empleado_Nombre_Via', 'Empleado_Nro', 'Empleado_Pais_Nacimiento', 'Empleado_Dpto_Nacimiento', 'Empleado_Prov_Nacimiento', 'Empleado_Dist_Nacimiento', 'Empleado_Dpto_Residencia', 'Empleado_Prov_Residencia', 'Empleado_Dist_Residencia', 'Empleado_sexo', 'Empleado_Tlf', 'Empleado_Tlf_Referencia', 'Empleado_Preguntar_Por', 'Empleado_Celular', 'Empleado_Email', 'Empleado_Dni', 'Empleado_Clave_Acceso', 'Empleado_Ruc', 'Empleado_Lib_Militar', 'Empleado_Num_Seguro', 'Empleado_Foto', 'EMPLEADO_CPSA_USUARIO', 'EMPLEADO_CPSA_PASSWORD', 'urba_nombre', 'empleado_interior', 'MODALIDAD_FORMATIVA', 'MODALIDAD_PAGO', 'TDI_CODIGO', 'CODIGO_NACIONALIDAD', 'CODIGO_ZONA', 'NOMBRE_ZONA', 'NIVEL_ESTUDIO', 'TIPO_ACTIVIDAD', 'TRABAJADOR_TIPO', 'DISCAPACIDAD', 'HORARIO_NOCTURNO', 'SINDICALIZADO', 'SITUACION_ESPECIAL', 'REGIMEN_ALTERNATIVO', 'JORNADA_MAXIMA', 'IPSS_VIDA'], 'string'],
            [['Usuario_Id', 'Retencion_judicial_cantidad'], 'number'],
            [['Empleado_Fecha_Nacimiento', 'Empleado_Fecha_Ingreso', 'Empleado_Fecha_Reg', 'empleado_fecha_modifica', 'regimen_fecha_inscripcion', 'FECHA_INSCRIPCION_OTRO'], 'safe'],
            [['turno_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CATurnos::className(), 'targetAttribute' => ['turno_codigo' => 'Turno_Codigo']],
            [['Local_Codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Locales::className(), 'targetAttribute' => ['Local_Codigo' => 'Local_Codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Empleado_Codigo' => 'Empleado  Codigo',
            'Empleado_Carnet' => 'Empleado  Carnet',
            'Empleado_Jefe' => 'Empleado  Jefe',
            'Usuario_Id' => 'Usuario  ID',
            'Usuario_Nick' => 'Usuario  Nick',
            'Ccto_Codigo' => 'Ccto  Codigo',
            'Ccr_Codigo' => 'Ccr  Codigo',
            'Ccb_Codigo' => 'Ccb  Codigo',
            'Empleado_Apellido_Paterno' => 'Empleado  Apellido  Paterno',
            'Empleado_Apellido_Materno' => 'Empleado  Apellido  Materno',
            'Empleado_Nombres' => 'Empleado  Nombres',
            'Empleado_Fecha_Nacimiento' => 'Empleado  Fecha  Nacimiento',
            'Empleado_Fecha_Ingreso' => 'Empleado  Fecha  Ingreso',
            'Empleado_Nombre_Via' => 'Empleado  Nombre  Via',
            'Empleado_Nro' => 'Empleado  Nro',
            'Empleado_Pais_Nacimiento' => 'Empleado  Pais  Nacimiento',
            'Empleado_Dpto_Nacimiento' => 'Empleado  Dpto  Nacimiento',
            'Empleado_Prov_Nacimiento' => 'Empleado  Prov  Nacimiento',
            'Empleado_Dist_Nacimiento' => 'Empleado  Dist  Nacimiento',
            'Empleado_Dpto_Residencia' => 'Empleado  Dpto  Residencia',
            'Empleado_Prov_Residencia' => 'Empleado  Prov  Residencia',
            'Empleado_Dist_Residencia' => 'Empleado  Dist  Residencia',
            'Empleado_sexo' => 'Empleado Sexo',
            'Empleado_Tlf' => 'Empleado  Tlf',
            'Empleado_Tlf_Referencia' => 'Empleado  Tlf  Referencia',
            'Empleado_Preguntar_Por' => 'Empleado  Preguntar  Por',
            'Empleado_Celular' => 'Empleado  Celular',
            'Empleado_Estado_Civil' => 'Empleado  Estado  Civil',
            'Empleado_Email' => 'Empleado  Email',
            'Empleado_Dni' => 'Empleado  Dni',
            'Empleado_Clave_Acceso' => 'Empleado  Clave  Acceso',
            'Empleado_Ruc' => 'Empleado  Ruc',
            'Empleado_Lib_Militar' => 'Empleado  Lib  Militar',
            'Empleado_Num_Seguro' => 'Empleado  Num  Seguro',
            'Empleado_Nivel' => 'Empleado  Nivel',
            'Empleado_trasvase' => 'Empleado Trasvase',
            'Empleado_Responsable_Area' => 'Empleado  Responsable  Area',
            'Empleado_Foto' => 'Empleado  Foto',
            'Moneda_Codigo' => 'Moneda  Codigo',
            'Postulante_Codigo' => 'Postulante  Codigo',
            'Empleado_activo' => 'Empleado Activo',
            'Estado_Codigo' => 'Estado  Codigo',
            'Empleado_Fecha_Reg' => 'Empleado  Fecha  Reg',
            'EMPLEADO_CPSA_USUARIO' => 'Empleado  Cpsa  Usuario',
            'EMPLEADO_CPSA_PASSWORD' => 'Empleado  Cpsa  Password',
            'Empleado_Clave_Modificada' => 'Empleado  Clave  Modificada',
            'turno_codigo' => 'Turno Codigo',
            'Empleado_dependientes' => 'Empleado Dependientes',
            'Empleado_hijos_mayores' => 'Empleado Hijos Mayores',
            'Retencion_judicial' => 'Retencion Judicial',
            'Retencion_judicial_cantidad' => 'Retencion Judicial Cantidad',
            'Local_Codigo' => 'Local  Codigo',
            'urba_nombre' => 'Urba Nombre',
            'empleado_interior' => 'Empleado Interior',
            'Rqto_Codigo' => 'Rqto  Codigo',
            'empleado_fecha_modifica' => 'Empleado Fecha Modifica',
            'MODALIDAD_FORMATIVA' => 'Modalidad  Formativa',
            'regimen_fecha_inscripcion' => 'Regimen Fecha Inscripcion',
            'MODALIDAD_PAGO' => 'Modalidad  Pago',
            'TDI_CODIGO' => 'Tdi  Codigo',
            'CODIGO_NACIONALIDAD' => 'Codigo  Nacionalidad',
            'CODIGO_ZONA' => 'Codigo  Zona',
            'NOMBRE_ZONA' => 'Nombre  Zona',
            'NIVEL_ESTUDIO' => 'Nivel  Estudio',
            'TIPO_ACTIVIDAD' => 'Tipo  Actividad',
            'TRABAJADOR_TIPO' => 'Trabajador  Tipo',
            'DISCAPACIDAD' => 'Discapacidad',
            'HORARIO_NOCTURNO' => 'Horario  Nocturno',
            'SINDICALIZADO' => 'Sindicalizado',
            'SITUACION_ESPECIAL' => 'Situacion  Especial',
            'CODIGO_REGIMEN' => 'Codigo  Regimen',
            'FECHA_INSCRIPCION_OTRO' => 'Fecha  Inscripcion  Otro',
            'REGIMEN_ALTERNATIVO' => 'Regimen  Alternativo',
            'JORNADA_MAXIMA' => 'Jornada  Maxima',
            'IPSS_VIDA' => 'Ipss  Vida',
        ];
    }

    public function getAuthKey() {
        return null;
    }

    public function getId() {
        return $this->Empleado_Codigo;
    }

    public function validateAuthKey($authKey) {
        return null;
    }

    public static function findIdentity($id) {
        return self::findOne(["Empleado_Codigo" => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }
    
    public static function validaUsuarioClave($id, $clave)
    {
       
         $obj = new EmpleadoLoginAcceso();

        $rpta = $obj->queryEmpresa();

        if($rpta == 'OK') {

           
            return self::findOne(["Empleado_Dni" => $id,"Empleado_Clave_Acceso"=> md5($clave),'Empleado_activo'=>1]);


        }

    }

    public function empleadoRolPagina($rol_str)
    {

        $rpta = "";

        $rs = Yii::$app->db->CreateCommand("SELECT distinct pagina_Codigo
                FROM pagina_rol
                WHERE empresa_codigo = ".$this->empresa_codigo." And sistema_codigo = ".$this->sistema_codigo." And rol_codigo in (".$rol_str.")  and pagina_rol_activo=1")->queryAll();

        $sCad="";
         if(count($rs)>0) {

            foreach ($rs as $row) {

                if($sCad == "") $sCad = trim($row["pagina_Codigo"]);
                else $sCad = $sCad.','.trim($row["pagina_Codigo"]);

            }

        $rs = Yii::$app->db->CreateCommand("SELECT pagina_url
                FROM pagina
                WHERE empresa_codigo = ".$this->empresa_codigo." And sistema_codigo = ".$this->sistema_codigo." And pagina_Codigo in (".$sCad.")  and pagina_activo=1")->queryAll();


            $arr_acciones = array();
            
            if(count($rs)>0) {
                $url_arr = explode('/',Url::to(''));
                $url_actual =$url_arr[count($url_arr)-2];
   
                foreach ($rs as $row) {

                       $arr_tmp  = explode('/',$row['pagina_url']);
                       
                        if(strtolower(trim($arr_tmp[count($arr_tmp)-1])) != 'ninguno') {

                            
                            if($url_actual == trim($arr_tmp[count($arr_tmp)-2])) {

                                 $arr_acciones[] = trim($arr_tmp[count($arr_tmp)-1]) ;

                            }
                           

                        }

                }

                     
            }

         
            return $arr_acciones;
         }
    }
    
    public function empleadoRol()
    {
        
         $rpta = "";

         $rs = Yii::$app->db->CreateCommand("SELECT  rol_codigo, rol_descripcion 
                FROM vEmpleado_rol_pagina
                WHERE (empresa_codigo = ".$this->empresa_codigo.") And (sistema_codigo = ".$this->sistema_codigo.") And (empleado_codigo = ".Yii::$app->user->identity->Empleado_Codigo.")
                GROUP BY rol_codigo, rol_descripcion 
                ORDER BY rol_codigo")->queryAll();

         
         $sCad="";
         if(count($rs)>0) {

            foreach ($rs as $row) {

                if($sCad == "") $sCad = trim($row["rol_codigo"]);
                else $sCad = $sCad.','.trim($row["rol_codigo"]);

            }

            $rpta = $sCad;


            return $rpta;

         }
 
    }


    public function queryEmpresa(){

        $rpta = "OK";

        $obj = new EmpleadoLoginAcceso();

        $row = Yii::$app->db->CreateCommand(" SELECT empresa_descripcion, 
                             empresa_direccion, 
                             empresa_db, 
                             empresa_url,
                             empresa_login,
                             empresa_password,
                             fecha_reg,
                             empresa_activo 
                      FROM empresa 
                      WHERE empresa_codigo = ".$obj->empresa_codigo)->queryOne();



        if (count($row)>0) {

            $obj->empresa_descripcion = $row['empresa_descripcion'];
            $obj->empresa_direccion   = $row['empresa_direccion'];
            $obj->empresa_db          = $row['empresa_db'];
            $obj->empresa_url         = $row['empresa_url'];
            $obj->empresa_login       = $row['empresa_login'];
            $obj->empresa_password    = $row['empresa_password'];
            $obj->empresa_activo      = $row['empresa_activo'];

        }else{

            $rpta = "Empresa no existente";
        }

        return $rpta;
    }


    public function menu(){

        $connection = \Yii::$app->db;

        $ssql = "
                with menuAtento
                as
                (
                    select menu_codigo,empresa_codigo,sistema_codigo,menu_codigo_padre,menu_orden 
                    from menu 
                    where menu_codigo_padre is null and empresa_codigo=:empresa_codigo and sistema_codigo=:sistema_codigo 
                    union all 
                    select m.menu_codigo,m.empresa_codigo,m.sistema_codigo,m.menu_codigo_padre,m.menu_orden+1
                    from menu m
                    join menuAtento p on m.menu_codigo_padre=p.menu_codigo and m.empresa_codigo=p.empresa_codigo and m.sistema_codigo=p.sistema_codigo
                    where m.menu_codigo_padre is not null 
                )
                select  distinct m.menu_codigo, m.menu_descripcion, m.pagina_codigo,p.pagina_url, m.menu_orden,  
                case when m.menu_codigo_padre is null then 0 else m.menu_codigo_padre end as menu_codigo_padre,  
                case when m.menu_url is null then 0 else m.menu_url end as menu_url,  
                m.menu_query,m.menu_anchor,m.menu_target
                ,me.menu_orden
                from menuAtento me
                inner join menu m on me.menu_codigo=m.menu_codigo
                inner join pagina p on m.empresa_codigo=p.empresa_codigo and m.sistema_codigo=p.sistema_codigo and m.pagina_codigo = p.pagina_codigo  
                inner join pagina_rol pr on p.empresa_codigo=pr.empresa_codigo and p.sistema_codigo=pr.sistema_codigo and p.pagina_codigo = pr.pagina_codigo and pr.pagina_rol_activo=1  
                inner join empleado_rol er on pr.empresa_codigo=er.empresa_codigo and pr.sistema_codigo=er.sistema_codigo and pr.rol_codigo = er.rol_codigo and er.empleado_rol_activo=1  
                where er.empleado_codigo = :empleado_codigo
                order by 3,6,5,11
                ";


         $params = [':empresa_codigo' =>$this->empresa_codigo,':sistema_codigo'=>$this->sistema_codigo,':empleado_codigo'=>Yii::$app->user->identity->Empleado_Codigo];
        $model = $connection->createCommand($ssql)->bindValues($params);
        $users = $model->queryAll();
        return $users;
    }


    private function ConsultaHijosMenu($cod_tarea_padre) 
    {

        $dataMenuChild = [];

       
        foreach ($this->dsMenuChild as $rowMenu) {
            //selecionar solo los hijos

            if($rowMenu['menu_codigo_padre']==$cod_tarea_padre) {

                $items = array();

                if($rowMenu['pagina_codigo']==0) {
                    //recursivo por sus hijos
                    $items['label'] = $rowMenu['menu_descripcion'];
                    $items['icon']  = 'cube';//'fa fa-database';
                    $items['url'] = ($rowMenu['pagina_url']=='Ninguno')?'javascript:void(0)':$rowMenu['pagina_url'];//"javascript:void(0)";


                    $tieneChild = $this->ConsultaHijosMenu($rowMenu['menu_codigo']);
                    if(count($tieneChild)>0) {
                        $items['items'] = $tieneChild;
                    }
            
                }else {
                    
                    $items['label'] = $rowMenu['menu_descripcion'];
                    $items['url'] = $rowMenu['pagina_url'];
                    //$items['icon']  = 'fa cube';
                   // $items['active']  = ($this->context->route == $rowMenu['pagina_url']) ? true:false ;
                   

                }
                
                
                if(count($items)>0) {

                    array_push($dataMenuChild,$items);  
                }

            }

        }
        
        return $dataMenuChild;

    }


    public function obtenMenu() 
    {

        $dataMenu = [];
        if(!empty(Yii::$app->user->identity->Empleado_Codigo)) {

            $this->dsMenuChild = $dsMenu = $this->menu();


            foreach ($dsMenu as $rowMenu) {
                //selecionar solo los padres
                if($rowMenu['pagina_codigo']==0 && $rowMenu['menu_codigo_padre']==0)
                {
                    $items = array();
                    $items['label'] = $rowMenu['menu_descripcion'];
                    $items['icon']  = 'cube';
                    $items['url']   = 'javascript:void(0)';
                  
                    $tieneChild = $this->ConsultaHijosMenu($rowMenu['menu_codigo']);
                    if(count($tieneChild)>0) {
                        $items['items'] = $tieneChild;
                    }

                    array_push($dataMenu,$items);  

                }else{
                    break;
                }

            }

        }
        return $dataMenu;

     }


    public function obtenAcciones()
    {

    
        if (Yii::$app->user->identity) {
              
            
            $empleadoRol_str = $this->empleadoRol();


            if($empleadoRol_str !='') {

                $acciones_arr = $this->empleadoRolPagina($empleadoRol_str);

                return $acciones_arr;

            }else {

                Yii::$app->response->redirect(['main/noautorizado']);

            }

        }   

    }
   

}
