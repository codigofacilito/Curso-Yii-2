<?php

use yii\db\Schema;
use yii\db\Migration;

class m151001_234359_activ_proy_bitacora extends Migration
{
        public function safeUp() {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {

            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci

            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Proyectos}}', [
            'idProyecto' => $this->primaryKey(),
            'NombreProyecto' => $this->string(200)->unique(),
            'Activo' => $this->boolean()
                ], $tableOptions);

        $this->createTable('{{%Actividades}}', [
            'idActividad' => $this->primarykey(),
            'NombreActividad' => $this->string(200)->unique(),
            'Activo' => $this->boolean(),
            'idProyecto' => $this->integer()
                ], $tableOptions);

        $this->createTable('{{%Bitacoratiempos}}', [
            'idBitacoraTiempo' => $this->primaryKey(),
            'Fecha' => $this->date(),
            'HoraInicio' => $this->time(),
            'HoraFinal' => $this->time(),
            'Interrupcion' => $this->time(),
            'Total' => $this->float(),
            'ActividadNoPlaneada' => $this->string(250),
            'idActividadPlaneada' => $this->integer(),
            'idProyecto' => $this->integer(),
            'Artefacto' => $this->string(250),
            'idUsuario' => $this->integer()
                ], $tableOptions);

        $this->addForeignKey('FK_act_proy', 'Actividades', 'idProyecto', 'Proyectos', 'idProyecto');
        $this->addForeignKey('FK_bitt_proy', 'Bitacoratiempos', 'idProyecto', 'Proyectos', 'idProyecto');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_act_proy', 'Actividades');
        $this->dropForeignKey('FK_bitt_proy', 'Bitacoratiempos');
        $this->dropTable('{{%Proyectos}}');
        $this->dropTable('{{%Actividades}}');
        $this->dropTable('{{%Bitacoratiempos}}');
    }


    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
