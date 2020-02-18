<?php

namespace Drupal\commerce_recruiting;

use Drupal\commerce_recruiting\Entity\CampaignInterface;
use Drupal\commerce_recruiting\Entity\Invoice;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class InvoiceManager.
 */
class InvoiceManager implements InvoiceManagerInterface {

  /**
   * The recruiting manager.
   *
   * @var \Drupal\commerce_recruiting\RecruitingManagerInterface
   */
  protected $recruitingManager;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * InvoiceManager constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\commerce_recruiting\RecruitingManagerInterface $recruiting_manager
   *   The recruiting manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, RecruitingManagerInterface $recruiting_manager) {
    $this->entityTypeManager = $entity_type_manager;
    $this->recruitingManager = $recruiting_manager;
  }

  /**
   * {@inheritDoc}
   */
  public function createInvoice(CampaignInterface $campaign) {
    /** @var \Drupal\commerce_recruiting\Entity\Invoice $invoice */
    $invoice = Invoice::create(['name' => $campaign->getName()]);
    $recruitings = $this->recruitingManager->findRecruitingByCampaign($campaign, 'accepted');

    /** @var \Drupal\commerce_recruiting\Entity\RecruitingInterface $recruiting */
    foreach ($recruitings as $recruiting) {
      $invoice->addRecruiting($recruiting);
    }
    $invoice->save();
    return $invoice;
  }

}