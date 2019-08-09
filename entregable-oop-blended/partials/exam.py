def  devuelve_ciudades(*ciudades):
    for elemento in ciudades:
        #for subelemento in elemento:
            yield from elemento

ciudades_devueltas=devuelve_ciudades("CARACAS","madrid","zulia")

print(next(ciudades_devueltas))

print(next(ciudades_devueltas))
