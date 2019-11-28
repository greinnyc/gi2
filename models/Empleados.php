<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Empleados".
 *
 * @property int $Empleado_Codigo
 * @property string $Empleado_Carnet
 * @property int $Empleado_Jefe
 * @property double $Usuario_Id
 * @property string $Usuario_Nick
 * @property int $Ccto_Codigo
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
 * @property int $Empleado_Estado_Civil
 * @property string $Empleado_Email
 * @property string $Empleado_Dni
 * @property string $Empleado_Clave_Acceso
 * @property string $Empleado_Ruc
 * @property string $Empleado_Lib_Militar
 * @property string $Empleado_Num_Seguro
 * @property int $Empleado_Nivel
 * @property int $Empleado_trasvase
 * @property int $Empleado_Responsable_Area
 * @property string $Empleado_Foto
 * @property int $Moneda_Codigo
 * @property int $Postulante_Codigo
 * @property int $Empleado_activo
 * @property int $Estado_Codigo
 * @property string $Empleado_Fecha_Reg
 * @property string $EMPLEADO_CPSA_USUARIO
 * @property string $EMPLEADO_CPSA_PASSWORD
 * @property int $Empleado_Clave_Modificada
 * @property int $turno_codigo
 * @property int $Empleado_dependientes
 * @property int $Empleado_hijos_mayores
 * @property int $Retencion_judicial
 * @property double $Retencion_judicial_cantidad
 * @property int $Local_Codigo
 * @property string $urba_nombre
 * @property string $empleado_interior
 * @property int $Rqto_Codigo
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
 * @property int $CODIGO_REGIMEN
 * @property string $FECHA_INSCRIPCION_OTRO
 * @property string $REGIMEN_ALTERNATIVO
 * @property string $JORNADA_MAXIMA
 * @property string $IPSS_VIDA
 * @property string $Empleado_ultima_fecha_cese
 * @property string $referencia_direccion
 * @property string $Agrupacion_id
 * @property int $tc_codigo
 * @property int $turno_extendido
 * @property string $Empleado_Telefono_Codigo
 * @property int $tipo_extension_codigo
 * @property string $Empleado_dni_rut
 * @property string $Empleado_Rut_Valida
 *
 * @property Alimento[] $alimentos
 * @property Alimento[] $alimentos0
 * @property AreaLaboral[] $areaLaborals
 * @property Atributos[] $atributos
 * @property BioLector[] $bioLectors
 * @property BioLector[] $bioLectors0
 * @property BioPlataformaLector[] $bioPlataformaLectors
 * @property BioPlataformaLector[] $bioPlataformaLectors0
 * @property BuzonEmpleadoRespuesta[] $buzonEmpleadoRespuestas
 * @property BuzonEmpleadoRespuesta[] $buzonEmpleadoRespuestas0
 * @property BuzonSugerencia[] $buzonSugerencias
 * @property BuzonSugerencia[] $buzonSugerencias0
 * @property CAAsignacionEmpleados[] $cAAsignacionEmpleados
 * @property CAAsignacionEmpleados[] $cAAsignacionEmpleados0
 * @property CAAsistenciaEspecial[] $cAAsistenciaEspecials
 * @property CAAsistenciaIncidencias[] $cAAsistenciaIncidencias
 * @property CAAsistenciaResponsables[] $cAAsistenciaResponsables
 * @property CAEmpleadoRol[] $cAEmpleadoRols
 * @property CARoles[] $rolCodigos
 * @property CaIncidenciaAreas[] $caIncidenciaAreas
 * @property CaIncidenciaEmpleado[] $caIncidenciaEmpleados
 * @property CAIncidencias[] $incidenciaCodigos
 * @property CaMovilidad[] $caMovilidads
 * @property CaMovilidad[] $caMovilidads0
 * @property CaMovilidad[] $caMovilidads1
 * @property CaMovilidad[] $caMovilidads2
 * @property CaMovilidad[] $caMovilidads3
 * @property CATurnoCambios[] $cATurnoCambios
 * @property CATurnoCambios[] $cATurnoCambios0
 * @property CATurnoEmpleado[] $cATurnoEmpleados
 * @property CATurnoEmpleado[] $cATurnoEmpleados0
 * @property CATurnoEmpleadoCambios[] $cATurnoEmpleadoCambios
 * @property CATurnoEmpleadoCambios[] $cATurnoEmpleadoCambios0
 * @property Contratos[] $contratos
 * @property CPSAAdd[] $cPSAAdds
 * @property CPSAAdd[] $cPSAAdds0
 * @property CPSADel[] $cPSADels
 * @property CPSADel[] $cPSADels0
 * @property CpsaDelTipos[] $cpsaDelTipos
 * @property CpsaDelTipos[] $cpsaDelTipos0
 * @property CPSALogin[] $cPSALogins
 * @property CPSASolicitud[] $cPSASolicituds
 * @property CPSASolicitudEmpleados[] $cPSASolicitudEmpleados
 * @property CPSASolicitud[] $cPSASolicitudCodigos
 * @property CtoContrato[] $ctoContratos
 * @property CuentaBanco[] $cuentaBancos
 * @property CuentaCTS[] $cuentaCTSs
 * @property CuentaSeguros[] $cuentaSeguros
 * @property EjecutivoAreas[] $ejecutivoAreas
 * @property EmpleadoArea[] $empleadoAreas
 * @property EmpleadoCurso[] $empleadoCursos
 * @property EmpleadoEstudios[] $empleadoEstudios
 * @property EmpleadoHobbie[] $empleadoHobbies
 * @property EmpleadoIndicador $empleadoIndicador
 * @property EmpleadoMovimiento[] $empleadoMovimientos
 * @property EmpleadoMovimiento[] $empleadoMovimientos0
 * @property EmpleadoMovimiento[] $empleadoMovimientos1
 * @property EmpleadoRenovacion[] $empleadoRenovacions
 * @property EmpleadoResidencia[] $empleadoResidencias
 * @property EmpleadoServicio[] $empleadoServicios
 * @property EmpleadoTransporte[] $empleadoTransportes
 * @property CentroCosto $cctoCodigo
 * @property CentroBeneficio $ccbCodigo
 * @property Locales $localCodigo
 * @property CATurnos $turnoCodigo
 * @property CATurnosCombinacion $tcCodigo
 * @property Especiales[] $especiales
 * @property Estudios[] $estudios
 * @property EvaEmpleadosDirigidos[] $evaEmpleadosDirigidos
 * @property EvaMaestro[] $maestroCodigos
 * @property EvaToma[] $evaTomas
 * @property EvaluacionEmpleado[] $evaluacionEmpleados
 * @property Evaluaciones[] $evaluacionCodigos
 * @property Familiares[] $familiares
 * @property FichaSalidas[] $fichaSalidas
 * @property Imagenes[] $imagenes
 * @property JuegoEmpleadoRol[] $juegoEmpleadoRols
 * @property JuegoRoles[] $rolCodigos0
 * @property JuegoResultadosEmpleados[] $juegoResultadosEmpleados
 * @property Laborales[] $laborales
 * @property MXCargaDetalle[] $mXCargaDetalles
 * @property MXCargas[] $cargaCodigos
 * @property MXContactos[] $mXContactos
 * @property MXEmpleadoRol[] $mXEmpleadoRols
 * @property MXRoles[] $rolCodigos1
 * @property MXTransferenciaDetalle[] $mXTransferenciaDetalles
 * @property MXTransferencias[] $mXTransferencias
 * @property NomCesadosCostos[] $nomCesadosCostos
 * @property NomEmpleadoCostos[] $nomEmpleadoCostos
 * @property NomPendiente[] $nomPendientes
 * @property NomVariablesCesados[] $nomVariablesCesados
 * @property OtrosEstudios[] $otrosEstudios
 * @property PafAprobaciones[] $pafAprobaciones
 * @property PafEmpleadoRol[] $pafEmpleadoRols
 * @property PafRoles[] $rolCodigos2
 * @property PafSolicitudes[] $pafSolicitudes
 * @property ParientesEmpresa[] $parientesEmpresas
 * @property RefEmpleadoRol[] $refEmpleadoRols
 * @property RefEmpleadoRol[] $refEmpleadoRols0
 * @property RefRoles[] $rolCodigos3
 * @property RefRoles[] $rolCodigos4
 * @property RefRoles[] $rolCodigos5
 * @property RefRoles[] $rolCodigos6
 * @property Referencias[] $referencias
 * @property Referidos[] $referidos
 * @property RqtoResponsable[] $rqtoResponsables
 * @property RqtoResponsable[] $rqtoResponsables0
 * @property Requerimientos[] $rqtoCodigos
 * @property Requerimientos[] $rqtoCodigos0
 * @property Requerimientos[] $rqtoCodigos1
 * @property Requerimientos[] $rqtoCodigos2
 * @property RrhhReporteAcademicoDetalle[] $rrhhReporteAcademicoDetalles
 * @property SolicitudRenuncia[] $solicitudRenuncias
 * @property Vacaciones[] $vacaciones
 * @property VacacionesDerecho[] $vacacionesDerechoes
 * @property VacacionesLog[] $vacacionesLogs
 * @property VacacionesLog[] $vacacionesLogs0
 * @property VacacionesSolicitud[] $vacacionesSolicituds
 * @property VacacionesSolicitud[] $vacacionesSolicituds0
 * @property VacacionesSolicitud[] $vacacionesSolicituds1
 */
class Empleados extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    

 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Empleado_Codigo'], 'required'],
            [['Empleado_Codigo', 'Empleado_Jefe', 'Ccto_Codigo', 'Empleado_Estado_Civil', 'Empleado_Nivel', 'Empleado_trasvase', 'Empleado_Responsable_Area', 'Moneda_Codigo', 'Postulante_Codigo', 'Empleado_activo', 'Estado_Codigo', 'Empleado_Clave_Modificada', 'turno_codigo', 'Empleado_dependientes', 'Empleado_hijos_mayores', 'Retencion_judicial', 'Local_Codigo', 'Rqto_Codigo', 'CODIGO_REGIMEN', 'tc_codigo', 'turno_extendido', 'tipo_extension_codigo'], 'integer'],
            [['Empleado_Carnet', 'Usuario_Nick', 'Ccr_Codigo', 'Ccb_Codigo', 'Empleado_Apellido_Paterno', 'Empleado_Apellido_Materno', 'Empleado_Nombres', 'Empleado_Nombre_Via', 'Empleado_Nro', 'Empleado_Pais_Nacimiento', 'Empleado_Dpto_Nacimiento', 'Empleado_Prov_Nacimiento', 'Empleado_Dist_Nacimiento', 'Empleado_Dpto_Residencia', 'Empleado_Prov_Residencia', 'Empleado_Dist_Residencia', 'Empleado_sexo', 'Empleado_Tlf', 'Empleado_Tlf_Referencia', 'Empleado_Preguntar_Por', 'Empleado_Celular', 'Empleado_Email', 'Empleado_Dni', 'Empleado_Clave_Acceso', 'Empleado_Ruc', 'Empleado_Lib_Militar', 'Empleado_Num_Seguro', 'Empleado_Foto', 'EMPLEADO_CPSA_USUARIO', 'EMPLEADO_CPSA_PASSWORD', 'urba_nombre', 'empleado_interior', 'MODALIDAD_FORMATIVA', 'MODALIDAD_PAGO', 'TDI_CODIGO', 'CODIGO_NACIONALIDAD', 'CODIGO_ZONA', 'NOMBRE_ZONA', 'NIVEL_ESTUDIO', 'TIPO_ACTIVIDAD', 'TRABAJADOR_TIPO', 'DISCAPACIDAD', 'HORARIO_NOCTURNO', 'SINDICALIZADO', 'SITUACION_ESPECIAL', 'REGIMEN_ALTERNATIVO', 'JORNADA_MAXIMA', 'IPSS_VIDA', 'referencia_direccion', 'Agrupacion_id', 'Empleado_Telefono_Codigo', 'Empleado_dni_rut', 'Empleado_Rut_Valida'], 'string'],
            [['Usuario_Id', 'Retencion_judicial_cantidad'], 'number'],
            [['Empleado_Fecha_Nacimiento', 'Empleado_Fecha_Ingreso', 'Empleado_Fecha_Reg', 'empleado_fecha_modifica', 'regimen_fecha_inscripcion', 'FECHA_INSCRIPCION_OTRO', 'Empleado_ultima_fecha_cese'], 'safe'],
            [['Empleado_Codigo'], 'unique'],
            [['Ccto_Codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCosto::className(), 'targetAttribute' => ['Ccto_Codigo' => 'Ccto_Codigo']],
            [['Ccb_Codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CentroBeneficio::className(), 'targetAttribute' => ['Ccb_Codigo' => 'Ccb_Codigo']],
            [['Local_Codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Locales::className(), 'targetAttribute' => ['Local_Codigo' => 'Local_Codigo']],
            [['turno_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CATurnos::className(), 'targetAttribute' => ['turno_codigo' => 'Turno_Codigo']],
            [['tc_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CATurnosCombinacion::className(), 'targetAttribute' => ['tc_codigo' => 'tc_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Empleado_Codigo' => 'Empleado Codigo',
            'Empleado_Carnet' => 'Empleado Carnet',
            'Empleado_Jefe' => 'Empleado Jefe',
            'Usuario_Id' => 'Usuario ID',
            'Usuario_Nick' => 'Usuario Nick',
            'Ccto_Codigo' => 'Ccto Codigo',
            'Ccr_Codigo' => 'Ccr Codigo',
            'Ccb_Codigo' => 'Ccb Codigo',
            'Empleado_Apellido_Paterno' => 'Empleado Apellido Paterno',
            'Empleado_Apellido_Materno' => 'Empleado Apellido Materno',
            'Empleado_Nombres' => 'Empleado Nombres',
            'Empleado_Fecha_Nacimiento' => 'Empleado Fecha Nacimiento',
            'Empleado_Fecha_Ingreso' => 'Empleado Fecha Ingreso',
            'Empleado_Nombre_Via' => 'Empleado Nombre Via',
            'Empleado_Nro' => 'Empleado Nro',
            'Empleado_Pais_Nacimiento' => 'Empleado Pais Nacimiento',
            'Empleado_Dpto_Nacimiento' => 'Empleado Dpto Nacimiento',
            'Empleado_Prov_Nacimiento' => 'Empleado Prov Nacimiento',
            'Empleado_Dist_Nacimiento' => 'Empleado Dist Nacimiento',
            'Empleado_Dpto_Residencia' => 'Empleado Dpto Residencia',
            'Empleado_Prov_Residencia' => 'Empleado Prov Residencia',
            'Empleado_Dist_Residencia' => 'Empleado Dist Residencia',
            'Empleado_sexo' => 'Empleado Sexo',
            'Empleado_Tlf' => 'Empleado Tlf',
            'Empleado_Tlf_Referencia' => 'Empleado Tlf Referencia',
            'Empleado_Preguntar_Por' => 'Empleado Preguntar Por',
            'Empleado_Celular' => 'Empleado Celular',
            'Empleado_Estado_Civil' => 'Empleado Estado Civil',
            'Empleado_Email' => 'Empleado Email',
            'Empleado_Dni' => 'Empleado Dni',
            'Empleado_Clave_Acceso' => 'Empleado Clave Acceso',
            'Empleado_Ruc' => 'Empleado Ruc',
            'Empleado_Lib_Militar' => 'Empleado Lib Militar',
            'Empleado_Num_Seguro' => 'Empleado Num Seguro',
            'Empleado_Nivel' => 'Empleado Nivel',
            'Empleado_trasvase' => 'Empleado Trasvase',
            'Empleado_Responsable_Area' => 'Empleado Responsable Area',
            'Empleado_Foto' => 'Empleado Foto',
            'Moneda_Codigo' => 'Moneda Codigo',
            'Postulante_Codigo' => 'Postulante Codigo',
            'Empleado_activo' => 'Empleado Activo',
            'Estado_Codigo' => 'Estado Codigo',
            'Empleado_Fecha_Reg' => 'Empleado Fecha Reg',
            'EMPLEADO_CPSA_USUARIO' => 'E M P L E A D O C P S A U S U A R I O',
            'EMPLEADO_CPSA_PASSWORD' => 'E M P L E A D O C P S A P A S S W O R D',
            'Empleado_Clave_Modificada' => 'Empleado Clave Modificada',
            'turno_codigo' => 'Turno Codigo',
            'Empleado_dependientes' => 'Empleado Dependientes',
            'Empleado_hijos_mayores' => 'Empleado Hijos Mayores',
            'Retencion_judicial' => 'Retencion Judicial',
            'Retencion_judicial_cantidad' => 'Retencion Judicial Cantidad',
            'Local_Codigo' => 'Local Codigo',
            'urba_nombre' => 'Urba Nombre',
            'empleado_interior' => 'Empleado Interior',
            'Rqto_Codigo' => 'Rqto Codigo',
            'empleado_fecha_modifica' => 'Empleado Fecha Modifica',
            'MODALIDAD_FORMATIVA' => 'M O D A L I D A D F O R M A T I V A',
            'regimen_fecha_inscripcion' => 'Regimen Fecha Inscripcion',
            'MODALIDAD_PAGO' => 'M O D A L I D A D P A G O',
            'TDI_CODIGO' => 'T D I C O D I G O',
            'CODIGO_NACIONALIDAD' => 'C O D I G O N A C I O N A L I D A D',
            'CODIGO_ZONA' => 'C O D I G O Z O N A',
            'NOMBRE_ZONA' => 'N O M B R E Z O N A',
            'NIVEL_ESTUDIO' => 'N I V E L E S T U D I O',
            'TIPO_ACTIVIDAD' => 'T I P O A C T I V I D A D',
            'TRABAJADOR_TIPO' => 'T R A B A J A D O R T I P O',
            'DISCAPACIDAD' => 'D I S C A P A C I D A D',
            'HORARIO_NOCTURNO' => 'H O R A R I O N O C T U R N O',
            'SINDICALIZADO' => 'S I N D I C A L I Z A D O',
            'SITUACION_ESPECIAL' => 'S I T U A C I O N E S P E C I A L',
            'CODIGO_REGIMEN' => 'C O D I G O R E G I M E N',
            'FECHA_INSCRIPCION_OTRO' => 'F E C H A I N S C R I P C I O N O T R O',
            'REGIMEN_ALTERNATIVO' => 'R E G I M E N A L T E R N A T I V O',
            'JORNADA_MAXIMA' => 'J O R N A D A M A X I M A',
            'IPSS_VIDA' => 'I P S S V I D A',
            'Empleado_ultima_fecha_cese' => 'Empleado Ultima Fecha Cese',
            'referencia_direccion' => 'Referencia Direccion',
            'Agrupacion_id' => 'Agrupacion ID',
            'tc_codigo' => 'Tc Codigo',
            'turno_extendido' => 'Turno Extendido',
            'Empleado_Telefono_Codigo' => 'Empleado Telefono Codigo',
            'tipo_extension_codigo' => 'Tipo Extension Codigo',
            'Empleado_dni_rut' => 'Empleado Dni Rut',
            'Empleado_Rut_Valida' => 'Empleado Rut Valida',
        ];
    }
    
    /*INICIO*/

    public static function getDb()
    {
        return Yii::$app->get('db_zeus');
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
    
    public static function validaUsuarioClave($id, $clave){
        return self::findOne(["Empleado_Dni" => $id,"Empleado_Clave_Acceso"=> md5($clave)]);
    }
    /*FIN*/

    



}
