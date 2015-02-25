<?php

class Migration_Create_diary extends CI_Migration
{
    public function up(){
        
        $this->dbforge->add_field(array(
                    'food_diary_id' => array(
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
        $this->dbforge->add_key('food_diary_id',TRUE);
        $this->dbforge->create_table('food_diary');
        
        
                
            $this->dbforge->add_field(array(
                    'food_diary_meals_id' => array(
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
                    'food_diary_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
            ));
        $this->dbforge->add_key('food_diary_meals_id',TRUE);
        $this->dbforge->create_table('food_diary_meals');    
    }//up
    
    public function down(){
        $this->dbforge->drop_table('food_diary');
        $this->dbforge->drop_table('food_diary_meals');
    }//down
    
}