<?php

class Migration_Create_diary extends CI_Migration
{
    public function up(){
        
        $this->dbforge->add_field(array(
                    'fooddiary_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'date' => array(
                                'type' => 'date',
                                'null' => false
                                ),
                    'time' => array(
                                'type' => 'time',
                                'null' => true
                                ),
                    'calories' => array(
                                    'type' => 'int',
                                    'constraint' => 20,
                                    'unsigned' => TRUE,
                                    'null'  => true

                                ),
                    'meal_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'reason_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => true
			),
            ));
        $this->dbforge->add_key('fooddiary_id',TRUE);
        $this->dbforge->create_table('fooddiary');
        
    }//up
    
    public function down(){
        
    }//down
    
}