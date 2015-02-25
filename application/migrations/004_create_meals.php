<?php

class Migration_Create_meals extends CI_Migration
{
    public function up(){
        $this->dbforge->add_field(array(
                    'meal_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'mealname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                    'mealdescption' => array(
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
        $this->dbforge->add_key('meal_id',TRUE);
        $this->dbforge->create_table('meals');
        
        
            $this->dbforge->add_field(array(
                    'meals_groceries_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'meal_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'groceries_id' => array(
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
        $this->dbforge->add_key('meals_groceries_id',TRUE);
        $this->dbforge->create_table('meals_groceries');    
    }//up
    
    public function down(){
        $this->dbforge->drop_table('meals');
        $this->dbforge->drop_table('meals_groceries');
    }//down
    
}