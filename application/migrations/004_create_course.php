<?php

class Migration_Create_course extends CI_Migration
{
    public function up(){
        $this->dbforge->add_field(array(
                    'course_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'coursename' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                    'coursedescption' => array(
                                'type' => 'text',
                                'constraint'=> 200,
                                'null' => true
                                ),
            
                    'calories' => array(
                                    'type' => 'int',
                                    'constraint' => 20,
                                    'unsigned' => TRUE
                                ),
                    'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
			),
            ));
        $this->dbforge->add_key('course_id',TRUE);
        $this->dbforge->create_table('course');
        
        
            $this->dbforge->add_field(array(
                    'course_grocery_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'course_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'grocery_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'quantity' => array(
                                'type' => 'varchar',
				'constraint' => 50,
                                )

            ));
        $this->dbforge->add_key('course_grocery_id',TRUE);
        $this->dbforge->create_table('course_groceries');    
    }//up
    
    public function down(){
        $this->dbforge->drop_table('course');
        $this->dbforge->drop_table('course_groceries');
    }//down
    
}