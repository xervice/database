<?php
declare(strict_types=1);

namespace Xervice\Database\Business\Transaction;


use Propel\Runtime\Propel;

trait DatabaseTransactionTrait
{
    /**
     * @param callable $callable
     *
     * @throws \Throwable
     */
    public function useTransaction(callable $callable)
    {
        $connection = Propel::getConnection();
        $connection->beginTransaction();

        try {
            $callable();
            $connection->commit();
        } catch (\Exception $exception) {
            $connection->rollBack();
            throw $exception;
        } catch (\Throwable $throwable) {
            $connection->rollBack();
            throw $throwable;
        }
    }
}