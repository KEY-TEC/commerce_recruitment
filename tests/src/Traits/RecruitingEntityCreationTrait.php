<?php

namespace Drupal\Tests\commerce_recruitment\Traits;

use Drupal\commerce_price\Price;
use Drupal\commerce_recruitment\Entity\RecruitingConfig;
use Drupal\commerce_recruitment\Entity\RecruitingEntity;
use Drupal\commerce_recruitment\Entity\RecruitingEntityType;

/**
 * Provides methods to create recruiting entities.
 *
 * This trait is meant to be used only by test classes.
 */
trait RecruitingEntityCreationTrait {

  use FieldCreationTrait;

  /**
   * Install required product bundle / order type etc.
   */
  protected function installRecruitingEntity() {
    $recruiting_type = RecruitingEntityType::create([
      'id' => 'default',
    ]);
    $recruiting_type->save();
  }

  /**
   * Install required product bundle / order type etc.
   */
  protected function installRecruitingConfig() {
    $recruiting_type = RecruitingConfig::create([
      'id' => 'default',
    ]);
    $recruiting_type->save();
  }

  /**
   * Create an recruiting entity.
   *
   * @return \Drupal\commerce_recruitment\Entity\RecruitingEntityInterface
   *   The recruiting entity.
   */
  protected function createRecruitmentEntity(array $options = [
    'type' => 'default',
    'name' => 'test',
  ]) {
    $recruitment = RecruitingEntity::create($options);
    return $recruitment;
  }

  /**
   * Create an recruiting entity.
   *
   * @return \Drupal\commerce_recruitment\Entity\RecruitingConfig
   *   The recruiting entity.
   */
  protected function createRecruitmentConfig(array $options = [
    'type' => 'default',
    'name' => 'test',
  ]) {
    $recruitment = RecruitingConfig::create($options);
    return $recruitment;
  }

  /**
   * Setup recruitment config.
   *
   * @return \Drupal\commerce_recruitment\Entity\RecruitingConfig
   *   The recruitment config.
   */
  protected function recruitmentSetup() {
    $products = $this->shopSetup();
    $product_1 = $products[0];
    $recruter = $this->drupalCreateUser();
    $recruiting_config = RecruitingConfig::create([
      'name' => 'test_1',
      'bonus' => new Price('10', 'USD'),
      'recruiter' => ['target_id' => $recruter->id()],
    ]);
    return $recruiting_config;
  }

}
