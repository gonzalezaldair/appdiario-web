SELECT
    IFNULL(p.Prestamos, 0) AS Prestamos,
    IFNULL(g.Gastos, 0) AS Gastos,
    IFNULL(a.Abonos, 0) AS Abonos
FROM
    (
        SELECT
            :usuario AS usuario
    ) u
    LEFT JOIN (
        SELECT
            pre_USUARIO,
            SUM(pre_MontoPrestado) AS Prestamos
        FROM
            prestamo
        WHERE
            DATE(pre_Fecha) = :fecha
        GROUP BY
            pre_USUARIO
    ) p ON p.pre_USUARIO = u.usuario
    LEFT JOIN (
        SELECT
            gas_USUARIO,
            SUM(gas_Monto) AS Gastos
        FROM
            gasto
        WHERE
            DATE(gas_Fecha) = :fecha
        GROUP BY
            gas_USUARIO
    ) g ON g.gas_USUARIO = u.usuario
    LEFT JOIN (
        SELECT
            abo_USUARIO,
            SUM(abo_Monto) AS Abonos
        FROM
            abono
        WHERE
            DATE(abo_Fecha) = :fecha
        GROUP BY
            abo_USUARIO
    ) a ON a.abo_USUARIO = u.usuario;