<?php
      use MercadoPago\Client\Payment\PaymentClient;
      use MercadoPago\MercadoPagoConfig;

      const mp = new MercadoPago('YOUR_PUBLIC_KEY');
      const bricksBuilder = mp.bricks();

      MercadoPagoConfig::setAccessToken("YOUR_ACCESS_TOKEN");

      $client = new PaymentClient();
      $request_options = new MPRequestOptions();
      $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

      $payment = $client->create([
        "token" => $_POST['token'],
        "issuer_id" => $_POST['issuer_id'],
        "payment_method_id" => $_POST['paymentMethodId'],
        "transaction_amount" => (float) $_POST['transactionAmount'],
        "installments" => $_POST['installments'],
        "payer" => [
          "email" => $_POST['email'],
          "identification" => [
            "type" => $_POST['identificationType'],
            "number" => $_POST['number']
          ]
        ]
      ], $request_options);
      echo implode($payment);
    ?>

<html>
<head>
  <script src="https://sdk.mercadopago.com/js/v2">
  </script>
</head>
<body>
  <div id="paymentBrick_container">
  </div>
  <script>
  const mp = new MercadoPago('YOUR_PUBLIC_KEY', {
    locale: 'pt'
  });
  const bricksBuilder = mp.bricks();
    const renderPaymentBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          /*
            "amount" é a quantia total a pagar por todos os meios de pagamento com exceção da Conta Mercado Pago e Parcelas sem cartão de crédito, que têm seus valores de processamento determinados no backend através do "preferenceId"
          */
          amount: 10000,
          preferenceId: "<PREFERENCE_ID>",
          payer: {
            firstName: "",
            lastName: "",
            email: "",
          },
        },
        customization: {
          visual: {
            style: {
              theme: "default",
            },
          },
          paymentMethods: {
            creditCard: "all",
										debitCard: "all",
										ticket: "all",
										bankTransfer: "all",
										atm: "all",
										onboarding_credits: "all",
										wallet_purchase: "all",
            maxInstallments: 1
          },
        },
        callbacks: {
          onReady: () => {
            /*
             Callback chamado quando o Brick está pronto.
             Aqui, você pode ocultar seu site, por exemplo.
            */
          },
          onSubmit: ({ selectedPaymentMethod, formData }) => {
            // callback chamado quando há click no botão de envio de dados
            return new Promise((resolve, reject) => {
              fetch("/process_payment", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
              })
                .then((response) => response.json())
                .then((response) => {
                  // receber o resultado do pagamento
                  resolve();
                })
                .catch((error) => {
                  // manejar a resposta de erro ao tentar criar um pagamento
                  reject();
                });
            });
          },
          onError: (error) => {
            // callback chamado para todos os casos de erro do Brick
            console.error(error);
          },
        },
      };
      window.paymentBrickController = await bricksBuilder.create(
        "payment",
        "paymentBrick_container",
        settings
      );
    };
    renderPaymentBrick(bricksBuilder);
  </script>
</body>
</html>