if [ ! -d gltf ]; then
  mkdir gltf;
fi
if [ ! -d collada ]; then
  mkdir collada;
fi
for a in IFC/*.ifc ; do
    d=$(basename $a)
    echo "Converting $d"
    ./Binaries/IfcConvert IFC/$d  collada/$d.dae
    ./Binaries/COLLADA2GLTF-bin -i collada/$d.dae -o gltf/$d.gltf
done
