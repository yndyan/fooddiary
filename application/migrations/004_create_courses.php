<?php

class Migration_Create_courses extends CI_Migration
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
                    'coursedescription' => array(
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
        $this->dbforge->create_table('courses');
        
        
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
        $this->dbforge->create_table('courses_groceries');    
    }//up
    
    public function down(){
        $this->dbforge->drop_table('courses');
        $this->dbforge->drop_table('courses_groceries');
    }//down
    
}