// Import the Lalamove SDK
import * as SDKClient from '@lalamove/lalamove-js';

// Initialize the SDK client
const sdkClient = new SDKClient.ClientModule(
  new SDKClient.Config(
    "pk_test_572395d05c7a438f5a462402ea91f5cb",
    "sk_test_BZXAaq9B1/kjwzkBj1I3MDVZXyulbHIUABgPPoHJnpO+PzkULCwC3o16gIObEY8E",
    "sandbox" // Use "production" for live environment
  )
);

// Step 1: Create a quotation
async function createQuotation() {
  const stop1 = {
    coordinates: { lat: "13.764088", lng: "121.059236" },
    address: "University of Batangas, Philippines",
  };

  const stop2 = {
    coordinates: { lat: "13.771309", lng: "121.059387" },
    address: "RK Village 4, Kumintang Ilaya, Batangas City, Philippines",
  };

  const quotationPayload = SDKClient.QuotationPayloadBuilder.quotationPayload()
    .withLanguage("en_PH")
    .withServiceType("MOTORCYCLE")
    .withStops([stop1, stop2])
    .build();

  try {
    const quotation = await sdkClient.Quotation.create("PH", quotationPayload);
    console.log("Quotation created:", quotation);
    return quotation;
  } catch (error) {
    console.error("Error creating quotation:", error);
  }
}

// Step 2: Place an order using the quotation
async function placeOrder(quotation) {
  const orderPayload = SDKClient.OrderPayloadBuilder.orderPayload()
    .withIsPODEnabled(true)
    .withQuotationID(quotation.id)
    .withSender({
      stopId: quotation.stops[0].id,
      name: "John Doe",
      phone: "+639171234567",
    })
    .withRecipients([
      {
        stopId: quotation.stops[1].id,
        name: "Jane Smith",
        phone: "+639175678901",
        remarks: "",
      },
    ])
    .withMetadata({
      internalId: "ORDER123",
    })
    .build();

  try {
    const order = await sdkClient.Order.create("PH", orderPayload);
    console.log("Order placed:", order);
    return order;
  } catch (error) {
    console.error("Error placing order:", error);
  }
}

// Main function to run the example
async function runExample() {
  const quotation = await createQuotation();
  if (quotation) {
    const order = await placeOrder(quotation);
    if (order) {
      console.log("Order process completed successfully!");
    }
  }
}

runExample();