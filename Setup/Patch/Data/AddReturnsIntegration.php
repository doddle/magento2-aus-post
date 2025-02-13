<?php
declare(strict_types=1);

namespace AustraliaPost\Returns\Setup\Patch\Data;

use Magento\Integration\Api\IntegrationServiceInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;
use AustraliaPost\Returns\Helper\Data as DataHelper;
use Magento\Integration\Model\Integration;

class AddReturnsIntegration implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /** @var IntegrationServiceInterface */
    private $integrationService;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param IntegrationServiceInterface $integrationService
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        IntegrationServiceInterface $integrationService
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->integrationService = $integrationService;
    }

    /**
     * @inheritdoc
     */
    public function apply(): void
    {
        $this->integrationService->create([
            Integration::NAME => DataHelper::INTEGRATION_NAME,
            'resource' => [
                'Magento_Backend::admin',
                'AustraliaPost_Returns::returns',
                'AustraliaPost_Returns::variations'
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
