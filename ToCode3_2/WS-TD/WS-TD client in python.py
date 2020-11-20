from zeep import client
client=Client(wsdl="http://localhost/mywebservices/ConvertEURtoTND.wsdl")
result=client.service.ConvertEURtoTND(100)
print(result)